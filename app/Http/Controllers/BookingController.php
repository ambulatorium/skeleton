<?php

namespace App\Http\Controllers;

use App\Models\Appointment\Appointment;
use App\Models\Doctor\Doctor;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view-bookings|add-bookings']);
    }

    public function schedulingAppointment(Doctor $doctor)
    {
        $appointment_number = time();

        return view('bookings', [
            'doctor'         => $doctor,
            'date_of_visit'  => request('date'),
            'preferred_time' => request('preferred_time'),
            'appointment_number' => $appointment_number,
        ]);
    }
}
