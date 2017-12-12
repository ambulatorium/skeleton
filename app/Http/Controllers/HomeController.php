<?php

namespace App\Http\Controllers;

use App\Models\Doctor\Schedule;
use App\Models\Polyclinic\Polyclinic;
use App\Models\Doctor\Doctor;
use App\Models\Setting\Group\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function home()
    {
        return view('home', [
            'polyclinics' => Polyclinic::all(),
            'locations'   => Group::all(),
        ]);
    }

    public function searchSchedule()
    {
        $schedules = $this->getSchedules();

        return view('search.schedule', [
            'schedules'   => $schedules,
            'polyclinics' => Polyclinic::all(),
            'polyclinic'  => request('polyclinic'),
            'date'        => request('date'),
            'locations'   => Group::all(),
            'location'    => request('location'),
        ]);
    }

    public function searchDoctor(Doctor $doctor, $schedule)
    {
        $day = \Carbon\Carbon::parse($schedule)->format('l');
        $timeInterval = Schedule::with('doctor')->where([
                        ['day', $day],
                        ['doctor_id', $doctor->id],
                    ])->first();

        if (empty($timeInterval)) {
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
        return Schedule::whereHas('doctor.polyclinic', function ($q) {
            $q->where('name', request('polyclinic'));
        })
        ->whereHas('doctor.group', function ($q)
        {
            $q->where('health_care_name', request('location'));
        })
        ->with('doctor.group')->where('day', \Carbon\Carbon::parse(request('date'))->format('l'))
        ->get();
    }
}
