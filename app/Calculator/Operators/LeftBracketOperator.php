<?php

namespace App\Calculator\Operators;

class LeftBracketOperator extends AbstractOperator
{
    public OperatorType $sign = OperatorType::LEFT_BRACKET;
    public int $priority = 0;

}
