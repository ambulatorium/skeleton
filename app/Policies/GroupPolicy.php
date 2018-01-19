<?php

namespace App\Policies;

use App\User;
use App\Models\Setting\Group\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the appointment.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function update(User $user, Group $group)
    {
        return $user->can('edit-groups') || $group->id == $user->staff->group_id;
    }
}
