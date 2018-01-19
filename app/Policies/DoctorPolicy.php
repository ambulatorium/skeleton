<?php

namespace App\Policies;

use App\User;
use App\Models\Doctor\Doctor;
use Illuminate\Auth\Access\HandlesAuthorization;

class DoctorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the doctor.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        if ($user->can('view-doctors')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the doctor.
     *
     * @param  \App\User  $user
     * @param  \App\Doctor  $doctor
     * @return mixed
     */
    public function update(User $user, Doctor $doctor)
    {
        if ($user->role('doctor')) {
            return true;
        }

        return $doctor->id == $user->id;
    }
}
