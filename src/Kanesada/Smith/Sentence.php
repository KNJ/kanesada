<?php

namespace Wazly\Kanesada\Smith;

use Wazly\Kanesada\Validation\SentenceValidation;

class Sentence extends Text
{
    protected $validator = SentenceValidation::class;
}
