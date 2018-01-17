<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:owner']);
    }

    public function index()
    {
        $appointments = Appointment::with('doctor', 'patient')->paginate(10);

        return view('appointments.index', compact('appointments'));
    }
}
