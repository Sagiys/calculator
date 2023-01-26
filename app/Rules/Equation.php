<?php

namespace App\Rules;

use App\Calculator\Operators\AdditionOperator;
use Illuminate\Contracts\Validation\InvokableRule;
use Psy\Util\Str;

class Equation implements InvokableRule
{
    public function __invoke($attribute, $value, $fail)
    {
        $mathOperators = [
            '+', '-', '*', '/', '^'
        ];

        $leftBracketsCount = substr_count($value, "(");
        $rightBracketsCount = substr_count($value, ")");

        $difference = $leftBracketsCount <=> $rightBracketsCount;

        match ($difference) {
            1 => $fail("There are to many left brackets"),
            -1 => $fail("There are to many right brackets"),
            default => null
        };

        if (\Str::startsWith($value, $mathOperators)) {
            $fail("Equation can't start with any operator: " . \Arr::join($mathOperators, ', '));
        }

        if (\Str::endsWith($value, $mathOperators)) {
            $fail("Equation can't end with any operator: " . \Arr::join($mathOperators, ', '));
        }
    }
}
