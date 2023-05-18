<?php

namespace App\Events;

use App\Models\Flow;
use App\Models\FlowStorageField;
use App\Models\StorageValue;
use App\Models\Team;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StorageValueStored
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public StorageValue $storageValue)
    {
        //
    }

    public function flowStorageField(): FlowStorageField
    {
        return $this->storageValue->flowStorageField;
    }

    public function value(): mixed
    {
        return $this->storageValue->value;
    }

    public function team(): Team
    {
        return $this->storageValue->team;
    }

    public function flow(): Flow
    {
        return $this->storageValue->flow;
    }
}
