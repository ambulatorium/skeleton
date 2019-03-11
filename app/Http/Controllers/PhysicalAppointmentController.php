<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Reliqui\Ambulatory\ReliquiWorkingHours;
use Reliqui\Ambulatory\ReliquiHealthcareLocation;

class PhysicalAppointmentController extends Controller
{
    public function index()
    {
        $date = Carbon::parse(request('date'))->format('Y-m-d H:i:s');
        $locations = ReliquiHealthcareLocation::all();
        $schedules = ReliquiWorkingHours::with('doctor.user', 'doctor.specialties')
            ->whereLocationId(request('location'))
            ->where('start_date_time', '<=', $date)
            ->where('end_date_time', '>=', $date)
            ->get();

        return view('welcome', compact('locations', 'schedules'));
    }
}
