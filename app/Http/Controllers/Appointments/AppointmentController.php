<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;

class AppointmentController extends Controller
{
    public function index()
    {
        return redirect('/people');
    }

    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);
        
        return view('people.appointment', compact('appointment'));
    }
}
