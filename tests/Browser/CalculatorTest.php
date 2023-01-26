<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CalculatorTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_number_input_works(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('button[value="1"]')
                ->click('button[value="2"]')
                ->click('button[value="3"]')
                ->click('button[value="4"]')
                ->click('button[value="5"]')
                ->click('button[value="6"]')
                ->click('button[value="7"]')
                ->click('button[value="8"]')
                ->click('button[value="9"]')
                ->click('button[value="0"]')
                ->assertValue('.calculator-screen', '1234567890');
        });
    }

    public function test_number_operators_works(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('button[value="+"]')
                ->click('button[value="-"]')
                ->click('button[value="/"]')
                ->click('button[value="*"]')
                ->click('button[value="^"]')
                ->click('button[value="("]')
                ->click('button[value=")"]')
                ->assertValue('.calculator-screen', '+-/*^()');
        });
    }

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

    public function test_calculator_work(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');


            foreach (self::CASES as $case) {
                $browser->click('button[value="AC"]');
                foreach (str_split($case['equation_string']) as $char) {
                    $browser->click('button[value="' . $char . '"]');
                }
                $browser->assertValue('.calculator-screen', $case['equation_string']);
                $browser->click('.equal-sign');
                $browser->pause(500);
                $browser->assertValue('.calculator-screen', $case['result']);

            }
        });
    }
}
