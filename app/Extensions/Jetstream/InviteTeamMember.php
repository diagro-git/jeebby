<?php
namespace App\Extensions\Jetstream;

use App\Actions\Jetstream\InviteTeamMember as InviteTeamMemberBase;
use App\Models\Team;
use InvalidArgumentException;

class InviteTeamMember extends InviteTeamMemberBase
{
    protected function validate(Team $team, string $email, ?string $role): void
    {
        if($role === 'jeebby_system') {
            throw new InvalidArgumentException(__('You can not add system users to the team.'));
        }

        parent::validate($team, $email, $role);
    }


}
