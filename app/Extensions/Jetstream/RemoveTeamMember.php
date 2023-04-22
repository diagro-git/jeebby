<?php
namespace App\Extensions\Jetstream;

use App\Actions\Jetstream\RemoveTeamMember as RemoveTeamMemberBase;
use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class RemoveTeamMember extends RemoveTeamMemberBase
{

    protected function authorize(User $user, Team $team, User $teamMember): void
    {
        parent::authorize($user, $team, $teamMember);

        if($teamMember->isJeebbySystem()) {
            throw new AuthorizationException(__('Jeebby system can not be removed from a team.'));
        }
    }

}
