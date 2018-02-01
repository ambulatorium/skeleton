<?php

namespace App\Http\Controllers\Groups;

use Illuminate\Http\Request;
use App\Models\Setting\Group\Group;
use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin-group|admin-counter']);
    }

    public function appointment(Request $request, Group $group)
    {
        $this->authorize('appointment', $group);

        $appointments = $this->getAppointments($request, $group);

        return view('groups.appointments.index', [
            'group'        => $group,
            'appointments' => $appointments->load('patient'),
        ]);
    }

    public function showAppointment(Group $group, Appointment $appointment)
    {
        $this->authorize('appointment', $group);

        return view('groups.appointments.show', compact('group', 'appointment'));
    }

    public function checkinAppointment(Group $group, Appointment $appointment)
    {
        $this->authorize('appointment', $group);

        $appointment->fill(['status' => 'checked']);
        $appointment->save();

        flash('Successful! outpatients checked.')->success();

        return redirect('/'.$group->slug.'/appointments');
    }

    protected function getAppointments(Request $request, Group $group)
    {
        // maybe this can using vue.js
        $requestToken = $request->get('token');

        if ($requestToken) {
            $appointments = $group->appointments()
                              ->where([
                                  ['status', 'scheduled'],
                                  ['token', 'LIKE', "%$requestToken%"],
                                ])
                              ->get();
        } else {
            $appointments = $group->appointments()->where('status', 'scheduled')->get();
        }

        return $appointments;
    }
}
