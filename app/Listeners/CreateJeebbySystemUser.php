<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Jetstream\Events\TeamCreated;

class CreateJeebbySystemUser
{
    /**
     * Handle the event.
     */
    public function handle(TeamCreated $event): void
    {
        //create jeebby system user
        /** @var User $user */
        $user = User::factory()->jeebbySystem()->create();
        $event->team->users()->attach($user->id);
        $user->switchTeam($event->team);

        $user->createToken('Jeebby', ['storage:read', 'storage:write', 'monitor:write']);
    }
}
