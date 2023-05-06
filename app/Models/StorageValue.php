<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StorageValue extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'value'
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
