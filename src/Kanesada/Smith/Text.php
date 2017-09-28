<?php

namespace Wazly\Kanesada\Smith;

class Text
{
    protected $baseText;
    protected $text;

    protected function __construct($text)
    {
        $this->baseText = $text;
        $this->text = $text;
    }

    static public function new(string $text = ''): Text
    {
        return new static($text);
    }

    /**
     * Set alternative text.
     *
     * @param string $text
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

    public function __toString()
    {
        return $this->dump();
    }
}
