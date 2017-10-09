<?php

namespace Wazly\Kanesada\Validation;

class TextValidation implements ValidationInterface
{
    public function isValid(string $text): bool
    {
        return true;
    }

    public function hasWhiteSpaces(string $text): bool
    {
        return preg_match('/\s/', $text);
    }

    public function hasLeadingWhiteSpace(string $text): bool
    {
        return preg_match('/^\s/', $text);
    }

    public function hasTrailingWhiteSpace(string $text): bool
    {
        return preg_match('/\s$/', $text);
    }
}
