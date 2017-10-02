<?php

namespace Wazly\Kanesada\Exception;

use Exception;

class UndefinedMethodException extends Exception
{
    public function __construct($class, $method)
    {
        parent::__construct('Called method '.$class.'::'.$method.' is not defined');
    }
}
