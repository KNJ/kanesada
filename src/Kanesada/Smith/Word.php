<?php

namespace Wazly\Kanesada\Smith;

use Wazly\Kanesada\Validation\WordValidation;

class Word extends Text
{
    protected $validator = WordValidation::class;
}
