<?php

namespace App\Calculator;

use App\Calculator\Operators\AdditionOperator;
use App\Calculator\Operators\Associativity;
use App\Calculator\Operators\DivisionOperator;
use App\Calculator\Operators\LeftBracketOperator;
use App\Calculator\Operators\MultiplicationOperator;
use App\Calculator\Operators\PowerOperator;
use App\Calculator\Operators\RightBracketOperator;
use App\Calculator\Operators\SubtractionOperator;

class StringToRPNConverter
{
    public function __construct(private readonly string $equationString)
    {
    }

    public function convert()
    {
        $equationStringArray = $this->equationStringToArray($this->equationString);


        $input = collect($equationStringArray);
        $output = collect();
        $heap = collect();

        foreach ($input as $inputValue) {
            if (is_numeric($inputValue)) {
                $output->push((int)$inputValue);
                continue;
            }

            if ($inputValue instanceof LeftBracketOperator) {
                $heap->push($inputValue);
                continue;
            }

            if ($inputValue instanceof RightBracketOperator) {
                while ($operator = $heap->pop()) {
                    if ($operator instanceof LeftBracketOperator) {
                        break;
                    }
                    $output->push($operator);
                }
                continue;
            }

            if (!$heap->last()) {
                $heap->push($inputValue);
                continue;
            }

            if ($inputValue->associativity === Associativity::LEFT) {
                while ($heap->last()?->priority >= $inputValue->priority) {
                    $output->push($heap->pop());
                }
                $heap->push($inputValue);
            } else if ($inputValue->associativity === Associativity::RIGHT) {
                while ($heap->last()?->priority > $inputValue->priority) {
                    $output->push($heap->pop());
                }
                $heap->push($inputValue);
            }
        }

        while ($operator = $heap->pop()) {
            $output->push($operator);
        }

        return $output;
    }

    private function equationStringToArray(string $equationString): array
    {
        $equationStringSplitted = str_split($equationString);

        $equationStringArray = [];
        $numberBuffer = '';

        foreach ($equationStringSplitted as $character) {
            if (is_numeric($character)) {
                $numberBuffer .= $character;
                continue;
            }

            if ($numberBuffer !== '') {
                $equationStringArray [] = $numberBuffer;
                $numberBuffer = '';
            }

            $character = match ($character) {
                '+' => new AdditionOperator(),
                '-' => new SubtractionOperator(),
                '*' => new MultiplicationOperator(),
                '/' => new DivisionOperator(),
                '^' => new PowerOperator(),
                '(' => new LeftBracketOperator(),
                ')' => new RightBracketOperator(),
            };

            $equationStringArray [] = $character;
        }

        if ($numberBuffer !== '') {
            $equationStringArray [] = $numberBuffer;
        }

        return $equationStringArray;
    }
}
