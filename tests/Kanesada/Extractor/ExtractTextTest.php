<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Extractor;

use PHPUnit\Framework\TestCase;

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
}
