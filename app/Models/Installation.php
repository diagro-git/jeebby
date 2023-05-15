<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Installation extends Pivot
{
    use SoftDeletes;

    protected $table = 'installations';

    public function flow(): BelongsTo
    {
        return $this->belongsTo(Flow::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function flowStorageFields(): HasManyThrough
    {
        return $this->hasManyThrough(FlowStorageField::class, Flow::class);
    }
}
