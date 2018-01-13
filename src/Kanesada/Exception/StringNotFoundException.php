<?php

namespace Wazly\Kanesada\Exception;

use Exception;

class StringNotFoundException extends Exception
{
    public function __construct(string $text)
    {
        parent::__construct('"'.$text.'" is not found');
    }
}
