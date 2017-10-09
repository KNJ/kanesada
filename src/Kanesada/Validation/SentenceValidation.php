<?php

namespace Wazly\Kanesada\Validation;

class SentenceValidation extends TextValidation
{
    public function isValid(string $text): bool
    {
        return ! in_array(false, [
            ! $this->hasLeadingWhiteSpace($text),
            ! $this->hasTrailingWhiteSpace($text),
        ], true);
    }
}
