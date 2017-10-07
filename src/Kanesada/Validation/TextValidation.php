<?php

namespace Wazly\Kanesada\Validation;

class TextValidation implements ValidationInterface
{
    public function isValid(string $text): bool
    {
        return true;
    }

    public function hasLeadingSpace(string $text): bool
    {
        return preg_match('/^\s/', $text);
    }

    public function hasTrailingSpace(string $text): bool
    {
        return preg_match('/\s$/', $text);
    }
}
