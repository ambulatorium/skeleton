<?php

namespace App\Models\Setting\Staff;

class Role extends \Spatie\Permission\Models\Role
{
    public static function defaultRoles()
    {
        return [
            'owner',
            'administrator',
            'admin-group',
            'doctor',
            'nurse',
            'patient',
        ];
    }
}
