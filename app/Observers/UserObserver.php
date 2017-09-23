<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    public function creating(User $user)
    {
        $user->password = bcrypt($user->password);
    }
}