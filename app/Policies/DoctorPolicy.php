<?php

namespace App\Policies;

use App\User;
use App\Models\Doctor\Doctor;
use Illuminate\Auth\Access\HandlesAuthorization;

class DoctorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the doctor.
     *
     * @param  \App\User  $user
     * @param  \App\Doctor  $doctor
     * @return mixed
     */
    public function update(User $user, Doctor $doctor)
    {
        return $doctor->id == $user->doctor->id;
    }
}
