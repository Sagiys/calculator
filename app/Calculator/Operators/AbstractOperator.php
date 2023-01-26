<?php

namespace App\Calculator\Operators;

abstract class AbstractOperator
{
    public OperatorType $sign;
    public Associativity $associativity = Associativity::LEFT;
    public int $priority = -1;

    public function toString(): string
    {
        return $this->sign->value;
    }
}
