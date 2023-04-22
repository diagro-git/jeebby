<?php
namespace App\Extensions\Jetstream;

use App\Actions\Jetstream\DeleteUser as DeleteUserBase;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class DeleteUser extends  DeleteUserBase
{

    public function delete(User $user): void
    {
        $this->authorize($user);
        parent::delete($user);
    }

    private function authorize(User $user)
    {
        if($user->isJeebbySystem()) {
            throw new AuthorizationException(__('Jeebby system user can not be removed.'));
        }
    }

}
