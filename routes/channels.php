<?php

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('{team}.{flow}.{flowStorageField}', function(\App\Models\User $user,\App\Models\Team $team, \App\Models\Flow $flow, \App\Models\FlowStorageField $flowStorageField) {
    return $user->belongsToTeam($team); //check if flow is installed with team and field belongs to the flow.
});
