<?php

namespace App\Http\Controllers\Groups;

use App\Models\Setting\Group\Group;
use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;

class GroupController extends Controller
{
    public function appointment(Group $group)
    {
        $appointments = $group->appointments()
                              ->where('status', 'scheduled')
                              ->get();

        return view('groups.appointments.index', [
            'group'        => $group,
            'appointments' => $appointments->load('user'),
        ]);
    }

    public function showAppointment(Group $group, Appointment $appointment)
    {
        return view('groups.appointments.show', compact('group', 'appointment'));
    }

    public function confirmAppointment(Group $group, Appointment $appointment)
    {
        $appointment->fill(['status' => 'confirmed']);
        $appointment->save();

        flash('Successful! appointment confirmed.')->success();

        return redirect('/'.$group->slug.'/appointments');
    }
}
