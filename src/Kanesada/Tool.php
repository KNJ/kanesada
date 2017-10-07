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
