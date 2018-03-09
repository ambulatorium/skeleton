<?php

namespace App\Http\Controllers\Groups;

use App\Models\Patient\Patient;
use App\Filters\AppointmentFilters;
use App\Models\Setting\Group\Group;
use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;
use App\Http\Requests\PatientFormRequest;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin-group|admin-counter']);
    }

    public function index(Group $group, AppointmentFilters $filters)
    {
        $this->authorize('appointment', $group);

        return view('groups.appointments.index', [
            'group'        => $group,
            'appointments' => $group->appointments()->filter($filters)->oldest('preferred_time')->get(),
        ]);
    }

    public function show(Group $group, $appointment)
    {
        $this->authorize('appointment', $group);

        $appointment = $group->appointments()->whereToken($appointment)->firstOrFail();

        return view('groups.appointments.show', compact('group', 'appointment'));
    }

    public function update(Group $group, $appointment)
    {
        $this->authorize('appointment', $group);

        $appointment = $group->appointments()->whereToken($appointment)->firstOrFail();

        if (!$appointment->patient->is_verified) { abort(500); }

        $appointment->update(['status' => 'checked']);

        flash('Successful! outpatients checked.')->success();

        return redirect('/'.$group->slug.'/appointments');
    }

    public function verifyPatient(Group $group, Appointment $appointment, PatientFormRequest $request, $patient)
    {
        $this->authorize('appointment', $group);

        $patient_form = $appointment->patient()->whereId($patient);
        $patient_form->update(array_merge($request->all(), ['is_verified' => true]));

        flash()->success('Patient Verified');

        return redirect('/'.$group->slug.'/appointments/'.$appointment->token);
    }
}
