<?php
namespace App\Services\Storage\Enums;

use Illuminate\Database\Eloquent\Collection;

enum Aggregation: string
{

    case SUM        = 'sum';
    case AVG        = 'avg';
    case STD        = 'std';
    case MIN        = 'min';
    case MAX        = 'max';
    case DISTINCT   = 'distinct';

    public function aggregate(Collection $data)
    {
        switch($this)
        {
            case self::SUM:
                return $data->sum(fn($m) => $m->value);
            case self::AVG:
                return $data->avg(fn($m) => $m->value);
            case self::STD:
                throw new \Exception('To be implemented');
            case self::MIN:
                return $data->min(fn($m) => $m->value);
            case self::MAX:
                return $data->max(fn($m) => $m->value);
            case self::DISTINCT:
                return $data->unique('value');
        }
    }

}
