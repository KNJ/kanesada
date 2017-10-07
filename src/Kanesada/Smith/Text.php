<?php

namespace Wazly\Kanesada\Smith;

use Wazly\Kanesada\Tool;
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
     * Set alternative text.
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
     * Get (a part of) the current text and rollback to initial state.
     *
     * @param  string $target
     * @return mixed
     */
    public function flush(string $target = '', ...$args)
    {
        $output = $this->get($target, ...$args);
        $this->reset();

        return $output;
    }

    /**
     * Get (a part of) the current text.
     *
     * @param  string $target
     * @return mixed
     */
    public function get(string $target = '', ...$args)
    {
        if ($target !== '') {
            $method = 'get'.Tool::upperCamelCase($target);

            return $this->extractor->$method($this->text, ...$args);
        }

        return $this->text;
    }

    /**
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
            return call_user_func([$this->patch, $name], array_merge([$this->text], $args));
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
