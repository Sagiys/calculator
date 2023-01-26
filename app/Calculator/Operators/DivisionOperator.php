<?php

namespace App\Calculator\Operators;

class DivisionOperator extends AbstractOperator
{
    public OperatorType $sign = OperatorType::DIVISION;
    public int $priority = 2;

}
