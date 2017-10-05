<?php

namespace Wazly\Kanesada\Patch;

class JapaneseTextRule extends Rule
{
    protected function applyDoubleByteSpacesToSingle($text): string
    {
        return str_replace('　', ' ', $text);
    }
}
