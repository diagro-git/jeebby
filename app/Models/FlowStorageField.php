<?php

namespace App\Models;

use App\Models\Enums\StorageFieldType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlowStorageField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'flow_id',
        'name',
        'type',
        'input',
        'output',
    ];

    protected $casts = [
        'input' => 'boolean',
        'output' => 'boolean',
        'type' => StorageFieldType::class,
    ];

    public function flow(): BelongsTo
    {
        return $this->belongsTo(Flow::class);
    }
}
