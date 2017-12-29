<?php

namespace App\Http\Controllers\Doctors;

use Illuminate\Http\Request;
use App\Models\Doctor\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:doctor']);
    }

    public function index()
    {
        $schedules = Schedule::where('doctor_id', Auth::user()->doctor->id)->get();

        return view('people.schedule.index', compact('schedules'));
    }

    public function create()
    {
        return view('people.schedule.create');
    }

    public function store(ScheduleRequest $request)
    {
        $checkSchedules = Schedule::where([
            ['doctor_id', Auth::user()->doctor->id],
            ['day', $request->get('day')],
        ]);

        if ($checkSchedules->first()) {
            flash('Warning! Schedule you selected is already exist')->warning();

            return redirect()->back();
        }

        $schedule = Schedule::create($request->formSchedule());

        flash('Successful! New schedule created')->success();
        return redirect('/people/schedules');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
