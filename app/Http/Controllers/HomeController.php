<?php

namespace App\Http\Controllers;

use App\Models\Polyclinic\Polyclinic;
use App\Models\Doctor\Schedule;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show()
    {
        return view('home', ['polyclinics' => Polyclinic::all()]);
    }

    public function searchDoctor()
    {

        $schedules = $this->getSearch();

        return view('search.doctor', [
            'schedules' => $schedules,
            'polyclinics' => Polyclinic::all(),
            'polyclinic' => $polyclinic = request('polyclinic'),
            'date' => $date = request('date')
        ]);

    }

    protected function getSearch()
    {
        return Schedule::whereHas('doctor.polyclinic', function ($q) {
            $q->where('name', request('polyclinic'));
        })
        ->with('doctor')->where('day', \Carbon\Carbon::parse(request('date'))->format('l'))
        ->get();
    }
}
