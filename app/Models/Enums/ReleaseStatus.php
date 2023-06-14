<?php
namespace App\Models\Enums;

enum ReleaseStatus : int
{

    case DEV            = 0;
    case TEST           = 1;
    case ACCEPT         = 2;
    case PRODUCTION     = 3;

}
