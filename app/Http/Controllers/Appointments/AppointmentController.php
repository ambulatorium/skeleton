<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;

class AppointmentController extends Controller
{
    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);

        return view('people.appointments.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment)
    {
        $this->authorize('delete', $appointment);

        $appointment->delete();

        flash('Successful! appointment canceled')->success();

        return redirect('/people/inbox');
    }
}
