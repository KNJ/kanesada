<?php

namespace Wazly\Kanesada\Extractor;

use Wazly\Kanesada\Tool;
use Wazly\Kanesada\Exception\LineNotFoundException;

class TextExtractor implements ExtractorInterface
{
    public function getFirstLetter($text): string
    {
        return mb_substr(trim($text), 0, 1);
    }

    public function getLineAt(string $text, int $index): string
    {
        $copy = Tool::lineFeed($text);
        $lines = explode("\n", $copy);

        if (! isset($lines[$index])) {
            throw new LineNotFoundException($index);
        }

        return $lines[$index];
    }
}
