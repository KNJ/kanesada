<?php

namespace Wazly\Kanesada\Patch;

interface RuleInterface
{
    public function apply(string $text, ...$rules): string;
}
