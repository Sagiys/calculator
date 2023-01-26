<?php

namespace Tests\Unit;

use App\Calculator\Operators\AdditionOperator;
use App\Calculator\Operators\DivisionOperator;
use App\Calculator\Operators\LeftBracketOperator;
use App\Calculator\Operators\MultiplicationOperator;
use App\Calculator\Operators\PowerOperator;
use App\Calculator\Operators\RightBracketOperator;
use App\Calculator\Operators\SubtractionOperator;
use App\Calculator\StringToRPNConverter;
use PhpParser\Node\Expr\AssignOp\Mul;
use PHPUnit\Framework\TestCase;

class ConvertEquationStringToRPNTest extends TestCase
{
    public const CASES = [
        [
            "equation_string" => "3+4*2/(1-5)^2",
            "RPN" => ['3', '4', '2', '*', '1', '5', '-', '2', '^', '/', '+']
        ],
        [
            "equation_string" => "12+2*(3*4+10/5)",
            "RPN" => ['12', '2', '3', '4', '*', '10', '5', '/', '+', '*', '+']
        ],
        [
            "equation_string" => "(2+3)*5",
            "RPN" => ['2', '3', '+', '5', '*']
        ],
        [
            "equation_string" => "((2+7)/3+(14-3)*4)/2",
            "RPN" => ['2', '7', '+', '3', '/', '14', '3', '-', '4', '*', '+', '2', '/']
        ],
        [
            "equation_string" => "5+(1+2)*4-3",
            "RPN" => ['5', '1', '2', '+', '4', '*', '+', '3', '-']
        ],
    ];


    public function test_convert_equation_string_to_reverse_polish_notation()
    {
        foreach (self::CASES as $case) {
            $equationString = $case['equation_string'];
            $convertedEquation = (new StringToRPNConverter($equationString))->convert();

            $rpnWithoutObjects = $this->prepareConvertedEquationForStringForm($convertedEquation->toArray());

            $this->assertEquals($case['RPN'], $rpnWithoutObjects);
        }
    }

    private function prepareConvertedEquationForStringForm(array $plainRPN): array
    {
        $arr = [];

        foreach ($plainRPN as $character) {
            if (!is_numeric($character)) {
                $arr [] = $character->toString();
                continue;
            }

            $arr [] = $character;
        }

        return $arr;
    }
}
