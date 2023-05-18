<?php

namespace App\Events;

use App\Models\Flow;
use App\Models\FlowStorageField;
use App\Models\StorageValue;
use App\Models\Team;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InputValueStored implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        private StorageValue $storageValue
    )
    {
        //
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'input.value.new';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return ['value' => $this->value()];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('Team.' . $this->team()->id . '.Flow.' . $this->flow()->id . '.Field.' . $this->flowStorageField()->id),
        ];
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
