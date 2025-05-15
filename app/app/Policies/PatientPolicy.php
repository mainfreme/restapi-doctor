<?php

namespace App\Policies;

use App\Models\User;

class PatientPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function access(User $user, User $patient): bool
    {
        return $user->isDoctor() && $user->patients()->where('id', $patient->id)->exists();
    }
}
