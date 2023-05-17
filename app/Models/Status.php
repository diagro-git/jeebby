<?php

namespace App\Models;

use App\Models\Enums\StatusType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Status extends Model
{
    use SoftDeletes;

    protected $table = 'installation_statusses';

    protected $fillable = [
        'flow_id',
        'team_id',
        'status',
        'message',
    ];

    protected $casts = [
        'status' => StatusType::class,
    ];

    public function flow(): BelongsTo
    {
        return $this->belongsTo(Flow::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function scopeInstallation(Builder $query, Team $team, Flow $flow)
    {
        $query->where('team_id' , '=', $team->id)->where('flow_id', '=', $flow->id);
    }
}
