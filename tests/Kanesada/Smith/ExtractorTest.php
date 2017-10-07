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
            $text->get('some_letters', 1, 7)
        );
        $this->assertSame(
            'ummy te',
            $text->getSomeLetters(1, 7)
        );
        $this->assertSame(
            'dummy text',
            $text->get()
        );
    }

    public function testCallExtractorAndFlush()
    {
        $text = StubTextForExtractor::new('dummy text');

        $text->set('replaced text');
        $this->assertSame(
            'eplaced',
            $text->flush('some_letters', 1, 7)
        );
        $this->assertSame(
            'dummy text',
            $text->get()
        );

        $text->set('another text');
        $this->assertSame(
            'nother ',
            $text->flushSomeLetters(1, 7)
        );
        $this->assertSame(
            'dummy text',
            $text->get()
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
