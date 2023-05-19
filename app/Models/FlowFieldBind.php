<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlowFieldBind extends Model
{
    use SoftDeletes;

    protected static function booted()
    {
        static::saving(function(FlowFieldBind $bind) {
            /** @var Team $team */
            $team = auth()->user()->currentTeam();

            if(! $team->flows->contains($bind->flowStorageFieldInput->flow)) {
                throw new Exception('Input field is not installed in current team.');
            }
            if(! $team->flows->contains($bind->flowStorageFieldOutput->flow)) {
                throw new Exception('Output field is not installed in current team.');
            }

            if($team->id != $bind->team->id) {
                throw new Exception('Current team different from bind team!');
            }
            if($bind->flowStorageFieldInput->team->id != $bind->team->id) {
                throw new Exception('Input team invalid!');
            }
            if($bind->flowStorageFieldOutput->team->id != $bind->team->id) {
                throw new Exception('Output team invalid!');
            }
        });
    }

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
