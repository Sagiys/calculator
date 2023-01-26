<?php

namespace App\Calculator\Operators;

class MultiplicationOperator extends AbstractOperator
{
    public OperatorType $sign = OperatorType::MULTIPLICATION;
    public int $priority = 2;

}
