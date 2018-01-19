<?php

namespace App\Models\Setting\Staff;

class Permission extends \Spatie\Permission\Models\Permission
{
    public static function defaultPermissions()
    {
        return [
            'view-doctors',

            'view-patients',
            'add-patients',
            'edit-patients',
            'delete-patients',

        ];
    }
}
