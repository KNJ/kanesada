<?php

namespace Wazly\Kanesada\Patch;

use Wazly\Kanesada\Tool;

class TextRule extends Rule
{
    protected function applyNoSpaces($text): string
    {
        return str_replace(' ', '', $text);
    }

    protected function applyOnlyLineFeedForNewline($text): string
    {
        return Tool::lineFeed($text);
    }

    protected function applyNoNewLines($text): string
    {
        $text = Tool::lineFeed($text);

        return str_replace("\n", '', $text);
    }
}
