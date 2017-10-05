<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Patch;

use PHPUnit\Framework\TestCase;

final class ApplyJapaneseTextRuleTest extends TestCase
{
    public function setUp()
    {
        $this->patch = new JapaneseTextRule;
    }

    public function testApplyDoubleByteSpacesToSingle()
    {
        $this->assertSame(
            '全角スペース と半角スペース があります。',
            $this->patch->applyDoubleByteSpacesToSingle('全角スペース　と半角スペース があります。')
        );
    }
}
