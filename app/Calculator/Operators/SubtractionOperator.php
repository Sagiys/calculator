<?php

namespace App\Calculator\Operators;

class SubtractionOperator extends AbstractOperator
{
    public OperatorType $sign = OperatorType::SUBTRACTION;
    public int $priority = 1;

}
