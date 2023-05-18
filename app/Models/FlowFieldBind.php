<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlowFieldBind extends Model
{
    use SoftDeletes;

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function flowStorageFieldInput(): BelongsTo
    {
        return $this->belongsTo(FlowStorageField::class, 'flow_storage_field_input_id');
    }

    public function flowStorageFieldOutput(): BelongsTo
    {
        return $this->belongsTo(FlowStorageField::class, 'flow_storage_field_output_id');
    }
}
