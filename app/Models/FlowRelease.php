<?php

namespace App\Models;

use App\Models\Enums\ReleaseStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlowRelease extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = [
        'flow_id',
        'version',
        'status',
    ];

    protected $casts = [
        'status' => ReleaseStatus::class,
    ];

    public function flow(): BelongsTo
    {
        return $this->belongsTo(Flow::class);
    }

    public function getBranchName(): string
    {
        return $this->version . '-' . ucfirst($this->status->name);
    }
}
