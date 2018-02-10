<?php

namespace App\Models\Setting\Staff;

class Permission extends \Spatie\Permission\Models\Permission
{
    public static function defaultPermissions()
    {
        return [
            'view-doctors',

            'edit-groups',
            'edit-group',

            'view-invitation-groups',
            'view-invitation-group',

            'view-staffs-groups',
            'view-staffs-group',

            'checkin-appointment-group',
        ];
    }
}
