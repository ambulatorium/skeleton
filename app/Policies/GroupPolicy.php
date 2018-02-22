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
            return $group->id == $user->staff->group_id;
        }
    }

    public function staff(User $user, Group $group)
    {
        if ($user->can('view-staffs-groups')) {
            return true;
        }

        if ($user->can('view-staffs-group')) {
            return $group->id == $user->staff->group_id;
        }
    }

    /**
     * Determine whether the user can invite staffs in groups.
     *
     * @param User $user
     * @param Group $group
     * @return mixed
     */
    public function invitation(User $user, Group $group)
    {
        if ($user->can('view-invitation-groups')) {
            return true;
        }

        if ($user->can('view-invitation-group')) {
            return $group->id == $user->staff->group_id;
        }
    }

    /**
     * Determine whether user can view appointments in groups.
     *
     * @param User $user
     * @param Group $group
     * @return mixed
     */
    public function appointment(User $user, Group $group)
    {
        return $group->id == $user->staff->group_id;
    }
}
