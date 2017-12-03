<?php

namespace App\Http\Controllers;

use App\Models\Doctor\Doctor;
use App\Models\Appointment\Appointment;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view-bookings|add-bookings']);
    }
    
    public function appointment(Request $request)
    {
        $doctor = Doctor::findOrFail($request->get('doctor_id'));
        $date_of_visit = $request->get('date_of_visit');
        $appointment_number = time();

        $max_queue = Appointment::where([
            ['doctor_id', '=', $doctor->id],
            ['date_of_visit', '=', $date_of_visit],
        ])->max('queue_number');

        $queue_number = $max_queue + 1;

        return view('bookings', compact('doctor','queue_number','date_of_visit','appointment_number'));
    }
}
