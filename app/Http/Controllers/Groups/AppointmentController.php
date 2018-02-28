<?php

namespace App\Http\Controllers\Groups;

use Illuminate\Http\Request;
use App\Models\Setting\Group\Group;
use App\Filters\AppointmentFilters;
use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin-group|admin-counter']);
    }

    public function index(Group $group, AppointmentFilters $filters)
    {
        $this->authorize('appointment', $group);

        $appointments = $group->appointments()->where('status', 'scheduled')->filter($filters)->get();

        return view('groups.appointments.index', [
            'group'        => $group,
            'appointments' => $appointments,
        ]);
    }

    public function show(Group $group, Appointment $appointment)
    {
        $this->authorize('appointment', $group);

        return view('groups.appointments.show', compact('group', 'appointment'));
    }

    public function update(Group $group, Appointment $appointment)
    {
        $this->authorize('appointment', $group);

        $appointment->fill(['status' => 'checked']);
        $appointment->save();

        flash('Successful! outpatients checked.')->success();

        return redirect('/'.$group->slug.'/appointments');
    }
}
