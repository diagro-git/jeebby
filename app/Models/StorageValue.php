<?php

namespace App\Models;

use App\Models\Castables\StorageValueCastable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StorageValue extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'value'
    ];

    protected $casts = [
        'value' => StorageValueCastable::class
    ];


    public function installation(): BelongsTo
    {
        return $this->belongsTo(Installation::class);
    }

    public function storageField(): BelongsTo
    {
        return $this->belongsTo(FlowStorageField::class);
    }
}
