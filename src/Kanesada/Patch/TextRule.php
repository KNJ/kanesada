<?php

namespace Wazly\Kanesada\Patch;

class TextRule extends Rule
{
    protected function applyNoSpaces($text): string
    {
        return str_replace(' ', '', $text);
    }

    protected function applyOnlyLineFeedForNewline($text): string
    {
        return str_replace(["\r\n", "\r"], ["\n", "\n"], $text);
    }
}
