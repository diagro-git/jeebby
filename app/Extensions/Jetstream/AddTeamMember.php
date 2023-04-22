<?php
namespace App\Extensions\Jetstream;

use App\Actions\Jetstream\AddTeamMember as AddTeamMemberBase;
use App\Models\Team;
use App\Models\User;
use App\Rules\JetstreamRole;
use InvalidArgumentException;

class AddTeamMember extends AddTeamMemberBase
{
    public function add(User $user, Team $team, string $email, string $role = null): void
    {
        if($user->isJeebbySystem()) {
            throw new InvalidArgumentException(__('You can not add system users to the team.'));
        }

        parent::add($user, $team, $email, $role);
    }

    protected function rules(): array
    {
        $rules = parent::rules();
        $rules['role'] = ['required', 'string', new JetstreamRole()];
        return $rules;
    }
}
