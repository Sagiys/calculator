<?php

namespace App\Calculator\Operators;

enum OperatorType: string
{
    case ADDITION = "+";
    case SUBTRACTION = "-";
    case MULTIPLICATION = "*";
    case DIVISION = "/";
    case POWER = "^";
    case LEFT_BRACKET = "(";
    case RIGHT_BRACKET = ")";
}
