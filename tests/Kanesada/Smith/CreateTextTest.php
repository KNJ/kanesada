<?php
declare(strict_types=1);

namespace Wazly\Kanesada\Smith;

use PHPUnit\Framework\TestCase;

final class CreateTextTest extends TestCase
{
    public function testCanBeCreatedFromString(): void
    {
        $this->assertInstanceOf(
            Text::class,
            Text::new('abcdef')
        );
    }
}
