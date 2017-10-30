<?php

namespace Wazly\Kanesada\Smith;

use Wazly\Kanesada\Validation\UrlValidation;

class Url extends Text
{
    protected $validator = UrlValidation::class;
}
