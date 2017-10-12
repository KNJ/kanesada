<?php

namespace Wazly\Kanesada\Smith;

use Wazly\Kanesada\Tool;
use BadMethodCallException;
use Wazly\Kanesada\Patch\TextRule;
use Wazly\Kanesada\Extractor\TextExtractor;
use Wazly\Kanesada\Validation\TextValidation;
use Wazly\Kanesada\Exception\InvalidFormatException;
use Wazly\Kanesada\Exception\UndefinedMethodException;

class Text
{
    protected $baseText;
    protected $text;
    protected $extractor = TextExtractor::class;
    protected $patchRule = TextRule::class;
    protected $validator = TextValidation::class;

    protected function __construct($text)
    {
        $this->baseText = $text;
        $this->text = $text;
        $this->extractor = new $this->extractor;
        $this->patch = new $this->patchRule;
        $this->validator = new $this->validator;
    }

    /**
     * [Smithing]
     * Create new instance.
     *
     * @param  string $text
     * @return Text
     */
    public static function new(string $text = ''): self
    {
        $instance = new static($text);

        if ($instance->validate() === false) {
            throw new InvalidFormatException($text);
        }

        return $instance;
    }

    /**
     * [Smithing]
     * Set an alternative text.
     *
     * @param  string  $text
     * @return Text
     */
    public function set(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * [Smithing]
     * Rollback the text to initial state.
     *
     * @return Text
     */
    public function reset(): self
    {
        $this->text = $this->baseText;

        return $this;
    }

    /**
     * [Smithing]
     * Get (a part of) the current text and rollback to initial state.
     *
     * @param  string $target
     * @return string
     */
    public function flush(string $target = '', ...$args)
    {
        $output = $this->get($target, ...$args);
        $this->reset();

        return $output;
    }

    /**
     * [Smithing]
     * Replace some parts of the current text.
     *
     * @param  mixed $args
     * @return Text
     */
    public function replace(...$args): self
    {
        if (! isset($args[0])) {
            throw new BadMethodCallException('No arguments to function '.__CLASS__.'::replace()');
        }

        if (is_string($args[0])) {
            if (! isset($args[1])) {
                throw new BadMethodCallException('Missing one more argument to function '.__CLASS__.'::replace()');
            } elseif (! is_string($args[1])) {
                throw new BadMethodCallException('Argument 2 passed to function '.__CLASS__.'::replace() is not string');
            }

            $this->text = str_replace($args[0], $args[1], $this->text);
        }

        return $this;
    }

    /**
     * [Smithing]
     * Output the current text with a newline.
     *
     * @param  string $target
     * @param  mixed  $args
     * @return void
     */
    public function println(string $target = '', ...$args)
    {
        echo $this->get($target, ...$args).PHP_EOL;
    }

    /**
     * [Property]
     * Return the number of lines in the text.
     *
     * @return int
     */
    public function countLines(): int
    {
        $text = Tool::lineFeed($this->text);

        return 1 + mb_substr_count($text, "\n");
    }

    /**
     * [Extraction]
     * Get (a part of) the current text.
     *
     * @param  string $target
     * @param  mixed  $args
     * @return string
     */
    public function get(string $target = '', ...$args): string
    {
        if ($target !== '') {
            $method = 'get'.Tool::upperCamelCase($target);

            return $this->extractor->$method($this->text, ...$args);
        }

        return $this->text;
    }

    /**
     * [Patch]
     * Apply patch rules to the text.
     *
     * @param  string $rules
     * @return Text
     */
    public function apply(...$rules): self
    {
        $this->text = $this->patch->apply($this->text, ...$rules);

        return $this;
    }

    /**
     * [Validation]
     * Validate the text.
     *
     * @return bool
     */
    public function validate(): bool
    {
        return $this->validator->isValid($this->text);
    }

    public function __call($name, $args)
    {
        if (strpos($name, 'apply') === 0) {
            $this->text = call_user_func_array([$this->patch, $name], array_merge([$this->text], $args));

            return $this;
        } elseif (strpos($name, 'get') === 0) {
            return call_user_func_array([$this->extractor, $name], array_merge([$this->text], $args));
        } elseif (strpos($name, 'flush') === 0) {
            $text = $this->text;
            $this->reset();

            return call_user_func_array([$this->extractor, 'get'.substr($name, 5)], array_merge([$text], $args));
        }

        throw new UndefinedMethodException(__CLASS__, $name);
    }

    public function __toString()
    {
        return $this->get();
    }
}
