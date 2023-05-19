<?php

namespace App\Listeners;

use App\Events\StorageValueStored;
use App\Models\FlowFieldBind;
use App\Models\FlowStorageField;
use App\Services\StorageService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StorageValueBinder implements ShouldQueue
{

    private StorageService $service;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        $this->service = app(StorageService::class);
    }

    /**
     * Determine whether the listener should be queued.
     */
    public function shouldQueue(StorageValueStored $event): bool
    {
        return $event->flowStorageField()->output;
    }

    /**
     * Handle the event.
     */
    public function handle(StorageValueStored $event): void
    {
        /** @var FlowFieldBind $binding */
        foreach($event->flowStorageField()->bindings as $binding) {
            /** @var FlowStorageField $input */
            $input = $binding->flowStorageFieldInput;
            $this->service->store($event->team(), $input->flow, $input, $event->value());
        }
    }
}
