<?php

namespace Tests\Unit;

use App\Calculator\CalculatorProcessor;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public const CASES = [
        [
            "equation_string" => "3+4*2/(1-5)^2",
            "result" => 3.5
        ],
        [
            "equation_string" => "12+2*(3*4+10/5)",
            "result" => 40,
        ],
        [
            "equation_string" => "(2+3)*5",
            "result" => 25,
        ],
        [
            "equation_string" => "((2+7)/3+(14-3)*4)/2",
            "result" => 23.5
        ],
        [
            "equation_string" => "5+(1+2)*4-3",
            "result" => 14
        ],
    ];

    public function test_calculated_result_based_on_equation_string()
    {
        foreach (self::CASES as $case) {
            $result = (new CalculatorProcessor($case['equation_string']))->answer();
            $this->assertEquals($case['result'], $result);
        }
    }
}
