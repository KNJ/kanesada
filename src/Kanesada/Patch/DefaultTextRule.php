<?php

namespace Wazly\Kanesada\Patch;

class DefaultTextRule extends Rule
{
    protected function applyNoSpaces($text): string
    {
        return str_replace(' ', '', $text);
    }

    protected function applyTrim($text): string
    {
        return trim($text);
    }
}
