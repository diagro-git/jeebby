<?php
namespace App\Models\Enums;

enum StorageFieldType : int
{

    case TEXT       = 0;
    case INT        = 1;
    case DECIMAL    = 2;
    case DATE       = 3;
    case TIME       = 4;
    case DATETIME   = 5;
    case BOOLEAN    = 6;
    case JSON       = 7;
    case ARRAY      = 8;

}
