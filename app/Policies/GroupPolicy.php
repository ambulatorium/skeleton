<?php

namespace App\Policies;

use App\User;
use App\Models\Setting\Group\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the groups.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function update(User $user, Group $group)
    {
        if ($user->can('edit-groups')) {
            return true;
        }

        if ($user->can('edit-group')) {
            return $group->id === $user->staff->group_id;
        }
    }

    /**
     * Determine whether user can view appointments in group.
     *
     * @param User $user
     * @param Group $group
     * @return void
     */
    public function appointment(User $user, Group $group)
    {
        // if ($user->can('checkin-appointment-group')) {
        return $group->id === $user->staff->group_id;
        // }
    }
}
