<?php

namespace App\Http\Controllers;

use App\Calculator\CalculatorProcessor;
use App\Http\Requests\CalculatorRequest;
use App\Http\Resources\CalculatorResultResource;
use Illuminate\Http\Request;

class CalculatorAction extends Controller
{
    public function __invoke(CalculatorRequest $request)
    {
        $equationString = $request->equation;
        $result = (new CalculatorProcessor($equationString))->answer();

        return response()->json([
            'result' => $result
        ]);
    }
}
