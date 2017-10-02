<?php

namespace Wazly\Kanesada\Patch;

use Wazly\Kanesada\Exception\UndefinedMethodException;

abstract class Rule implements RuleInterface
{
    /**
     * Apply patch rules sequentially.
     *
     * The rule names must be snake case. This method cannot pass optional arguments.
     *
     * @param  string $text
     * @param  string $rules
     * @return string
     */
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
                $method = 'apply'.$rule;
                $text = $this->$method($text);
            }
        }

        return $text;
    }

    public function __call($name, $args): string
    {
        /**
         * Apply a patch rule with arguments.
         *
         * If an internal function "xxxx" (in "applyXxxx"), which is like "trim", can be
         * called, this object prefer to do so.
         */
        if (strpos($name, 'apply') === 0) {
            $ruleName = substr($name, 5);
            if (is_callable($ruleName)) {
                return call_user_func_array($ruleName, $args);
            } elseif (method_exists($this, $name)) {
                return call_user_func_array([$this, $name], $args);
            }
        }

        throw new UndefinedMethodException(__CLASS__, $name);
    }
}
