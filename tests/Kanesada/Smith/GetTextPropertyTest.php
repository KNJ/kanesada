<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Smith;

use PHPUnit\Framework\TestCase;
use Wazly\Kanesada\Exception\StringNotFoundException;

final class GetTextPropertyTest extends TestCase
{
    const MUL_STR = <<< EOL
12345
67891
01112
13141
51617
EOL;

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

    public function testFindPosition()
    {
        $text = Text::new(self::MUL_STR);
        $this->assertSame(
            [1, 1],
            $text->position('7')
        );
        $this->assertSame(
            [1, 3],
            $text->position('31')
        );
    }

    public function testFindNoPosition()
    {
        $text = Text::new(self::MUL_STR);
        $this->expectException(StringNotFoundException::class);
        $text->position('pos');
    }
}
