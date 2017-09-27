<?php

namespace Wazly\Kanesada\Smith;

class Text
{
    protected $text;

    protected function __construct($text)
    {
        $this->text = $text;
    }

    static public function new(string $text = ''): Text
    {
        return new static($text);
    }

    public function dumpText(): string
    {
        return $this->text;
    }

    public function __toString()
    {
        return $this->dumpText();
    }
}
