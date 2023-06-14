<?php
namespace App\Models\Enums;

enum StatusType : int
{

    case NOT_RUNNING        = 0;
    case RUNNING            = 1;
    case ERROR              = 2;
    case WARNING            = 3;
    case EXECUTED           = 4;

}
