<?php

namespace App\Models\Castables;

use App\Casts\StorageValueCast;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Database\Eloquent\CastsInboundAttributes;

class StorageValueCastable implements Castable
{


    /**
     * @inheritDoc
     */
    public static function castUsing(array $arguments): CastsAttributes|string|CastsInboundAttributes
    {
        return StorageValueCast::class;
    }
}
