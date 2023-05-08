<?php

namespace App\Policies;

use App\Models\Flow;
use App\Models\User;

class FlowPolicy
{

    public function view(User $user, Flow $flow)
    {
        return $user->tokenCan('storage:read');
    }

}
