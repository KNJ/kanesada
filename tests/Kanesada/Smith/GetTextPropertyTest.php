<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Smith;

use PHPUnit\Framework\TestCase;

final class GetTextPropertyTest extends TestCase
{
    public function testGetCountLines()
    {
        $text = Text::new(fixture('essay.txt'));
        $this->assertSame(8, $text->countLines());
    }

    public function testIfTextContainsSpecificText()
    {
        $text = Text::new('To avoid criticism, do nothing, say nothing, be nothing.');
        $this->assertTrue($text->has('To'));
        $this->assertTrue($text->has('nothing'));
        $this->assertFalse($text->has('to'));
    }
}
