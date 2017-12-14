<?php

namespace App\Models\Setting\Staff;

class Permission extends \Spatie\Permission\Models\Permission
{
    public static function defaultPermissions()
    {
        return [
            'view-polyclinics',
            'add-polyclinics',
            'edit-polyclinics',
            'delete-polyclinics',

            'view-doctors',
            'add-doctors',
            'edit-doctors',
            'delete-doctors',

            'view-schedules',
            'add-schedules',
            'edit-schedules',
            'delete-schedules',

            'view-patients',
            'add-patients',
            'edit-patients',
            'delete-patients',

            'view-appointments',
            'add-appointments',
            'edit-appointments',
            'delete-appointments',
            
            'view-bookings',
            'add-bookings',

        ];
    }
}
