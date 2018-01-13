<?php

namespace Wazly\Kanesada\Exception;

use Exception;

class LineNotFoundException extends Exception
{
    public function __construct(int $index)
    {
        parent::__construct('Line '.$index.' is not found');
    }
}
