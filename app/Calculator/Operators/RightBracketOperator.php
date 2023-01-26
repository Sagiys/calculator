<?php

namespace App\Calculator\Operators;

class RightBracketOperator extends AbstractOperator
{
    public OperatorType $sign = OperatorType::RIGHT_BRACKET;
    public int $priority = 1;

}
