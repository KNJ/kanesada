<?php

namespace Wazly\Kanesada\Patch;

abstract class Rule implements RuleInterface
{
    public function apply(string $text, ...$rules): string
    {
        foreach ($rules as $rule) {
            if (is_callable($rule)) {
                $text = $rule($text);
            } else {
                $sep = explode('_', $rule);
                $rule = [];
                foreach ($sep as $s) {
                    $rule[] = ucfirst($s);
                }
                $rule = implode('', $rule);
                $method = 'apply' . $rule;
                $text = $this->$method($text);
            }
        }

        return $text;
    }
}
