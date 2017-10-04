<?php

declare(strict_types=1);

namespace Wazly\Kanesada\Smith;

use PHPUnit\Framework\TestCase;
use Wazly\Kanesada\Extractor\ExtractorInterface;

final class ExtractorTest extends TestCase
{
    public function testCallExtractor()
    {
        $text = StubTextForExtractor::new('dummy text');
        $this->assertSame(
            'ummy te',
            $text->getSomeLetters(1, 7)
        );
    }
}

class StubTextForExtractor extends Text
{
    protected $extractor = StubExtractor::class;
}

class StubExtractor implements ExtractorInterface
{
    public function getSomeLetters(string $text, int $start, int $end): string
    {
        return substr($text, $start, $end);
    }
}
