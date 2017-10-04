<?php

namespace Wazly\Kanesada\Smith;

use Wazly\Kanesada\Extractor\TextExtractor;
use Wazly\Kanesada\Patch\TextRule;
use Wazly\Kanesada\Validation\TextValidation;
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

    public static function new(string $text = ''): Text
    {
        return new static($text);
    }

    /**
     * Set alternative text.
     *
     * @param  string  $text
     * @return Text
     */
    public function set(string $text): Text
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Rollback the text to initial state.
     *
     * @return Text
     */
    public function reset(): Text
    {
        $this->text = $this->baseText;

        return $this;
    }

    /**
     * Output the text and rollback to initial state.
     *
     * @return string
     */
    public function flush(): string
    {
        $text = $this->text;
        $this->reset();

        return $text;
    }

    /**
     * Output the current text.
     *
     * @return string
     */
    public function dump(): string
    {
        return $this->text;
    }

    /**
     * Apply patch rules to the text.
     *
     * @param  string $rules
     * @return Text
     */
    public function apply(...$rules): Text
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
        }

        throw new UndefinedMethodException(__CLASS__, $name);
    }

    public function __toString()
    {
        return $this->dump();
    }
}
