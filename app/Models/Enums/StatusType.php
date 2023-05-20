<?php
namespace App\Models\Enums;

enum StatusType : int
{

    case NOT_RUNNING        = 0;
    case RUNNING            = 1;
    case ERROR              = 2;
    case INSTALLING         = 3;
    case WARNING            = 4;

}
