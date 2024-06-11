<?php

// app/Policies/AdminPolicy.php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user can access the admin panel.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */

    public function accessAdmin(User $user)
    {
        return $user->account_type == 'admin';
    }

    public function accessDoctor(User $user)
    {
        return $user->account_type == 'doctor';
    }

    public function accessNurse(User $user)
    {
        return $user->account_type == 'nurse';
    }

    public function accessPatient(User $user)
    {
        return $user->account_type == 'patient';
    }

    public function isLoggedIn(?User $user)
    {
        return $user !== null;
    }
}
