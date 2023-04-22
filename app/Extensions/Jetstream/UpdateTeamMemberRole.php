<?php
namespace App\Extensions\Jetstream;

use Laravel\Jetstream\Actions\UpdateTeamMemberRole as UpdateTeamMemberRoleBase;

class UpdateTeamMemberRole extends UpdateTeamMemberRoleBase
{
    public function update($user, $team, $teamMemberId, string $role)
    {
        if(Jetstream::findUserByIdOrFail($teamMemberId)->isJeebbySystem()) {
            throw new \InvalidArgumentException(__('Can not change role for system user.'));
        }

        parent::update($user, $team, $teamMemberId, $role);
    }
}
