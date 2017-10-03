<?php

namespace Wazly\Kanesada\Validation;

class TextValidation implements ValidationInterface
{
    public function isValid(string $text): bool
    {
        return true;
    }
}
