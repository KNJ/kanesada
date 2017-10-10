<?php

namespace Wazly\Kanesada;

final class Tool
{
    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
        //
    }

    public static function lineFeed(string $text): string
    {
        return str_replace(["\r\n", "\r"], ["\n", "\n"], $text);
    }

    public static function upperCamelCase(string $text): string
    {
        $tmp = [];
        $words = explode('_', $text);
        foreach ($words as $w) {
            $tmp[] = ucfirst($w);
        }

        return implode('', $tmp);
    }
}
