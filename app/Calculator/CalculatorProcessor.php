<?php

namespace App\Calculator;

class CalculatorProcessor
{
    private StringToRPNConverter $converter;
    private RPNCalculator $calculator;

    public function __construct(public readonly string $equationString)
    {
        $this->converter = new StringToRPNConverter($this->equationString);
        $this->calculator = new RPNCalculator($this->converter->convert());
    }

    public function answer()
    {
        return $this->calculator->calculate();
    }
}
