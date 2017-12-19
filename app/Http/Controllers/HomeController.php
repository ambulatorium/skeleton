<?php

namespace App\Http\Controllers;

use App\Models\Doctor\Schedule;
use App\Models\Setting\Speciality\Speciality;
use App\Models\Doctor\Doctor;
use App\Models\Setting\Group\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            return redirect('/people');
        }
        
        return view('home', [
            'specialities' => Speciality::all(),
            'locations'    => Group::all(),
        ]);
    }

    public function searchSchedule()
    {
        $schedules = $this->getSchedules();

        return view('search.schedule', [
            'schedules'    => $schedules,
            'specialities' => Speciality::all(),
            'speciality'   => request('speciality'),
            'date'         => request('date'),
            'locations'    => Group::all(),
            'location'     => request('location'),
        ]);
    }

    public function searchDoctor(Doctor $doctor, $schedule)
    {
        $today = today();
        $day = \Carbon\Carbon::parse($schedule)->format('l');
        $timeInterval = Schedule::with('doctor')->where([
                        ['day', $day],
                        ['doctor_id', $doctor->id],
                    ])->first();

        if (empty($timeInterval) || $schedule < $today) {
            abort(404);
        }

        $from_time = new Carbon($timeInterval->from_time);
        $to_time = new Carbon($timeInterval->to_time);

        return view('search.doctor',[
            'doctor'    => $doctor,
            'from_time' => $from_time,
            'to_time'   => $to_time,
            'date'      => $schedule,
        ]);
    }

    protected function getSchedules()
    {
        return Schedule::whereHas('doctor.speciality', function ($q) {
            $q->where('name', request('speciality'));
        })
        ->whereHas('doctor.group', function ($q)
        {
            $q->where('health_care_name', request('location'));
        })
        ->with('doctor.group')->where('day', \Carbon\Carbon::parse(request('date'))->format('l'))
        ->get();
    }
}
