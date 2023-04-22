<?php

namespace App\Listeners;

use App\Extensions\Jetstream\Jetstream;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Jetstream\Events\TeamCreated;

class CreateJeebbySystemUser
{
    /**
     * Create a new Jeebby System user and assign it to the new team
     */
    public function handle(TeamCreated $event): void
    {
        /** @var User $user */
        $user = User::factory()->jeebbySystem()->create();
        $event->team->users()->attach($user->id, ['role' => 'jeebby_system']);
        $user->switchTeam($event->team);

        $user->createToken('Jeebby', Jetstream::findRole('jeebby_system')?->permissions ?? []);
    }
}
