<?php

namespace App\Http\Controllers\Groups;

use App\Models\Patient\Patient;
use App\Filters\AppointmentFilters;
use App\Models\Setting\Group\Group;
use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;
use App\Http\Requests\VerifyPatientRequest;

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
            'appointments' => $group->allAppointments()->filter($filters)->get(),
        ]);
    }

    public function show(Group $group, $appointment)
    {
        $this->authorize('appointment', $group);

        $appointment = $group->appointments()->whereToken($appointment)->firstOrFail();

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

    public function verifyPatient(Group $group, Appointment $appointment, Patient $patient, VerifyPatientRequest $request)
    {
        $this->authorize('appointment', $group);

        $patient->update($request->verifiedPatient());

        flash()->success('Patient Verified');

        return redirect('/'.$group->slug.'/appointments/'.$appointment->token);
    }
}
