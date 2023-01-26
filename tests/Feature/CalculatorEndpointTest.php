<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalculatorEndpointTest extends TestCase
{
    private const CASES = [
        [
            "equation_string" => "3+4*2/(1-5)^2",
            "result" => 3.5,
            'code' => 200,
        ],
        [
            "equation_string" => "12+2*(3*4+10/5)",
            "result" => 40,
            'code' => 200,
        ],
        [
            "equation_string" => "(2+3)*5",
            "result" => 25,
            'code' => 200,
        ],
        [
            "equation_string" => "((2+7)/3+(14-3)*4)/2",
            "result" => 23.5,
            'code' => 200,
        ],
        [
            "equation_string" => "5+(1+2)*4-3",
            "result" => 14,
            'code' => 200,
        ],
        [
            "equation_string" => "+5*3",
            "result" => null,
            'code' => 422,
            'number_of_errors' => 1
        ],
        [
            "equation_string" => "5+3-",
            "result" => null,
            'code' => 422,
            'number_of_errors' => 1
        ],
        [
            "equation_string" => "(3+5))",
            "result" => null,
            'code' => 422,
            'number_of_errors' => 1
        ],
        [
            "equation_string" => "((3+5)",
            "result" => null,
            'code' => 422,
            'number_of_errors' => 1
        ],
        [
            "equation_string" => "((3+5)-",
            "result" => null,
            'code' => 422,
            'number_of_errors' => 2
        ],
    ];


    public function test_calculator_api()
    {
        foreach (self::CASES as $case) {
            $response = $this->postJson('/api/calculate', ['equation' => $case['equation_string']]);

            if ($case['code'] === 200) {
                $response
                    ->assertStatus($case['code'])
                    ->assertJson([
                        'result' => $case['result']
                    ]);
            } else {
                $response->assertStatus($case['code'])
                    ->assertJsonCount($case['number_of_errors'], 'errors.equation');
            }

        }

    }
}
