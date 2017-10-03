<?php

namespace Wazly\Kanesada\Validation;

interface ValidationInterface
{
    public function isValid(string $text): bool;
}
