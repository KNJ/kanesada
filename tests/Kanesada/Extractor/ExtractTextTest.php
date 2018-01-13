<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Extractor;

use PHPUnit\Framework\TestCase;
use Wazly\Kanesada\Exception\LineNotFoundException;

final class ExtractTextTest extends TestCase
{
    public function setUp()
    {
        $this->extractor = new TextExtractor;
    }

    public function testGetFirstLetter()
    {
        $this->assertSame(
            'L',
            $this->extractor->getFirstLetter("\nLetter")
        );
    }

    public function testGetTextAtSingleLine()
    {
        $this->assertSame(
            'http://www.custom-essays.org/examples/Wisdom_definition_essay.html',
            $this->extractor->getLineAt(fixture('essay.txt'), 6)
        );
    }

    public function testFailToGetTextAtSingleLine()
    {
        $this->expectException(LineNotFoundException::class);
        $this->extractor->getLineAt(fixture('essay.txt'), 8);
    }
}
