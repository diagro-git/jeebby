<?php
namespace App\Services\Storage\Enums;

enum Aggregation: string
{

    case SUM        = 'sum';
    case AVG        = 'avg';
    case STD        = 'std';
    case MIN        = 'min';
    case MAX        = 'max';
    case DISTINCT   = 'distinct';

}
