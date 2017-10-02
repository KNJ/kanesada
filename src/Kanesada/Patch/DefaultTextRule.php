<?php

namespace Wazly\Kanesada\Patch;

class DefaultTextRule extends Rule
{
    protected function applyNoSpaces($text): string
    {
        return str_replace(' ', '', $text);
    }
}
