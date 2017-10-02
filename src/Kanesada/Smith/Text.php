<?php

namespace Wazly\Kanesada\Smith;

use Wazly\Kanesada\Patch\DefaultTextRule;
use Wazly\Kanesada\Exception\UndefinedMethodException;

class Text
{
    protected $baseText;
    protected $text;
    protected $patchRule = DefaultTextRule::class;

    protected function __construct($text)
    {
        $this->baseText = $text;
        $this->text = $text;
        $this->patch = new $this->patchRule;
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

    public function __call($name, $args)
    {
        if (strpos($name, 'apply') === 0) {
            return call_user_func([$this->patch, $name], array_merge([$this->text], $args));
        }

        throw new UndefinedMethodException(__CLASS__, $name);
    }

    public function __toString()
    {
        return $this->dump();
    }
}
