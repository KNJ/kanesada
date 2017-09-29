<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Smith;

use PHPUnit\Framework\TestCase;

final class SmithTextTest extends TestCase
{
    const INI_STR = 'Anything one man can imagine, other men can make real.';

    public function setUp()
    {
        $this->originalString = self::INI_STR;
        $this->text = Text::new($this->originalString);
    }

    public function testDumpOriginalString(): void
    {
        $this->assertSame(self::INI_STR, $this->text->dump());
    }
}
