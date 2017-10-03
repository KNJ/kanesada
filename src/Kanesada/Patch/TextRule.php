<?php

namespace Wazly\Kanesada\Patch;

class TextRule extends Rule
{
    protected function applyNoSpaces($text): string
    {
        return str_replace(' ', '', $text);
    }
}
