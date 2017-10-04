<?php

namespace Wazly\Kanesada\Extractor;

class TextExtractor implements ExtractorInterface
{
    public function getFirstLetter($text): string
    {
        return mb_substr(trim($text), 0, 1);
    }
}
