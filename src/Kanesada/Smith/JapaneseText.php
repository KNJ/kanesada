<?php

namespace Wazly\Kanesada\Smith;

use Wazly\Kanesada\Patch\JapaneseTextRule;

class JapaneseText extends Text
{
    protected $patchRule = JapaneseTextRule::class;
}
