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


    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function flow(): Flow
    {
        return $this->flowStorageField->flow;
    }

    public function flowStorageField(): BelongsTo
    {
        return $this->belongsTo(FlowStorageField::class);
    }
}
