<?php

namespace App\Models;

use App\Models\Enums\StorageFieldType;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlowStorageField extends Model
{
    use SoftDeletes, HasUlids;

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

    public function bindings(): HasMany
    {
        if($this->output === false) {
            throw new \Exception('Flow storage field is not an output.');
        }

        return $this->hasMany(FlowFieldBind::class, 'flow_storage_field_output_id');
    }
}
