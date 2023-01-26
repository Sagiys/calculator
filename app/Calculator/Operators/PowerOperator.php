<?php

namespace App\Calculator\Operators;

class PowerOperator extends AbstractOperator
{
    public OperatorType $sign = OperatorType::POWER;
    public Associativity $associativity = Associativity::RIGHT;
    public int $priority = 3;

}
