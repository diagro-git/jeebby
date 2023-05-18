<?php

use App\Models\Flow;
use App\Models\FlowStorageField;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('Team.{team}.Flow.{flow}.Field.{flowStorageField}', function(User $user, Team $team, Flow $flow, FlowStorageField $flowStorageField) {
    return $user->belongsToTeam($team) && $team->flows->contains($flow->id) && $flow->flowStorageFields->contains($flowStorageField->id);
});
