<?php

namespace App\Http\Controllers;

use App\Models\Doctor\Schedule;
use App\Models\Polyclinic\Polyclinic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('home', ['polyclinics' => Polyclinic::all()]);
    }

    public function searchSchedule()
    {
        $schedules = $this->getSchedules();

        return view('search.schedule', [
            'schedules'   => $schedules,
            'polyclinics' => Polyclinic::all(),
            'polyclinic'  => request('polyclinic'),
            'date'        => request('date'),
        ]);
    }

    protected function getSchedules()
    {
        return Schedule::whereHas('doctor.polyclinic', function ($q) {
            $q->where('name', request('polyclinic'));
        })
        ->with('doctor')->where('day', \Carbon\Carbon::parse(request('date'))->format('l'))
        ->get();
    }
}
