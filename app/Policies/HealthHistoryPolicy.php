<?php

namespace App\Policies;

use App\User;
use App\Models\Patient\HealthHistory;
use Illuminate\Auth\Access\HandlesAuthorization;

class HealthHistoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the healthHistory.
     *
     * @param  \App\User  $user
     * @param  \App\HealthHistory  $healthHistory
     * @return mixed
     */
    public function view(User $user, HealthHistory $healthHistory)
    {
        return $healthHistory->user_id == $user->id;
    }
}
