<?php

namespace App\Http\Requests;

use App\Rules\Equation;
use Illuminate\Foundation\Http\FormRequest;

class CalculatorRequest extends FormRequest
{
    public function rules()
    {
        return [
            'equation' => ['required', 'string', new Equation]
        ];
    }
}
