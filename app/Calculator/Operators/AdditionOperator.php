<?php

namespace App\Calculator\Operators;

class AdditionOperator extends AbstractOperator
{
    public OperatorType $sign = OperatorType::ADDITION;
    public int $priority = 1;
}
