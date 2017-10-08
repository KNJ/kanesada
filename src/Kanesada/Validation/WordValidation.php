<?php

namespace Wazly\Kanesada\Validation;

class WordValidation extends TextValidation
{
    public function isValid(string $text): bool
    {
        return !in_array(false, [
            !$this->hasLeadingSpace($text),
            !$this->hasTrailingSpace($text),
        ], true);
    }
}
