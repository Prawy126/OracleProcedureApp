<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function accessAdmin(User $user)
    {
        return $user->account_type == 1;
    }

    public function accessDoctor(User $user)
    {
        return $user->account_type == 3;
    }

    public function accessNurse(User $user)
    {
        return $user->account_type == 2;
    }

    public function accessPatient(User $user)
    {
        return $user->account_type == 4;
    }

    public function isLoggedIn(?User $user)
    {
        return $user !== null;
    }
}

