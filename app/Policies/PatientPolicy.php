<?php

namespace App\Policies;

use App\User;
use App\Models\Patient\Patient;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the patient.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Patient\Patient  $patient_form
     * @return mixed
     */
    public function update(User $user, Patient $patient_form)
    {
        return $patient_form->user_id == $user->id;
    }
}
