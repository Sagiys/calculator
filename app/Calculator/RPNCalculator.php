<?php

namespace App\Calculator;

use App\Calculator\Operators\AdditionOperator;
use App\Calculator\Operators\DivisionOperator;
use App\Calculator\Operators\MultiplicationOperator;
use App\Calculator\Operators\PowerOperator;
use App\Calculator\Operators\SubtractionOperator;
use Illuminate\Support\Collection;

class RPNCalculator
{
    public function __construct(private readonly Collection $rpn)
    {
    }

    public function calculate()
    {
        $rpn = $this->rpn;

        $heap = collect();

        foreach ($rpn as $character) {
            if (is_numeric($character)) {
                $heap->push((int)$character);
                continue;
            }

            $secondNumber = $heap->pop();
            $firstNumber = $heap->pop();

            $newNumber = match ($character::class) {
                AdditionOperator::class => $firstNumber + $secondNumber,
                SubtractionOperator::class => $firstNumber - $secondNumber,
                MultiplicationOperator::class => $firstNumber * $secondNumber,
                DivisionOperator::class => $firstNumber / $secondNumber,
                PowerOperator::class => $firstNumber ** $secondNumber
            };

            $heap->push($newNumber);
        }

        return $heap->pop();
    }
}
