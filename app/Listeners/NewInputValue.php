<?php

namespace App\Listeners;

use App\Events\InputValueStored;
use App\Events\StorageValueStored;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewInputValue implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the listener should be queued.
     */
    public function shouldQueue(StorageValueStored $event): bool
    {
        return $event->flowStorageField()->input;
    }

    /**
     * Handle the event.
     */
    public function handle(StorageValueStored $event): void
    {
        InputValueStored::broadcast($event->storageValue);
    }
}
