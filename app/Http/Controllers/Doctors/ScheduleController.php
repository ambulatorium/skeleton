<?php

namespace App\Http\Controllers\Doctors;

use App\Models\Doctor\Schedule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ScheduleRequest;
use App\Models\Appointment\Appointment;

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

    public function show(Schedule $schedule)
    {
        $appointments = Appointment::with('user')->where('schedule_id', $schedule->id)->get();

        return view('people.schedule.show', compact('schedule', 'appointments'));
    }

    public function edit(Schedule $schedule)
    {
        return view('people.schedule.edit', compact('schedule'));
    }

    public function update(ScheduleRequest $request, Schedule $schedule)
    {
        $schedule->fill($request->formSchedule());
        $schedule->save();

        flash('Successful! Schedule updated.')->success();

        return redirect('/people/schedules');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        flash('Successful! Schedule deleted.')->success();

        return redirect('/people/schedules');
    }
}
