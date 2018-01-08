<?php

namespace App\Http\Controllers\Groups;

use App\Models\Setting\Group\Group;
use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;

class GroupController extends Controller
{
    public function appointment(Group $group)
    {
        $appointments = $group->appointments()->get();

        return view('groups.appointments.index', [
            'group'        => $group,
            'appointments' => $appointments->load('user'),
        ]);
    }

    public function showAppointment(Group $group, Appointment $appointment)
    {
        return view('groups.appointments.show', compact('group','appointment'));
    }
}
