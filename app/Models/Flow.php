<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flow extends Model
{
    use SoftDeletes, HasUlids;

    protected $fillable = [
        'name',
        'description',
    ];

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class)
            ->as('installation')
            ->using(Installation::class)
            ->withTimestamps();
    }

    public function storageFields(): HasMany
    {
        return $this->hasMany(FlowStorageField::class);
    }

}
