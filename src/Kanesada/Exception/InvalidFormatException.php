<?php

namespace Wazly\Kanesada\Exception;

use Exception;

class InvalidFormatException extends Exception
{
    public function __construct(string $text, bool $shouldHidden = false)
    {
        parent::__construct(
            'Input text'.($shouldHidden ? '' : ' "'.mb_strimwidth($text, 0, 20, '...')).'"'.' is not proper format'
        );
    }
}
