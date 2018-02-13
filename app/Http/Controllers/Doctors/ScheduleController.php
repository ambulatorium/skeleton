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

        $this->middleware('doctor.active')->only(['create', 'store']);
    }

    public function index()
    {
        $schedules = Schedule::withCount('appointments')->where('doctor_id', Auth::user()->doctor->id)->get();

        return view('users.schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('users.schedules.create');
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

        Schedule::create($request->formSchedule());

        flash('Successful! New schedule created')->success();

        return redirect(route('schedules.index'));
    }

    public function show(Schedule $schedule)
    {
        $this->authorize('update', $schedule);

        $appointments = Appointment::with('patient')->where('schedule_id', $schedule->id)->get();

        return view('users.schedules.show', compact('schedule', 'appointments'));
    }

    public function edit(Schedule $schedule)
    {
        $this->authorize('update', $schedule);

        return view('users.schedules.edit', compact('schedule'));
    }

    public function update(ScheduleRequest $request, Schedule $schedule)
    {
        $this->authorize('update', $schedule);

        $schedule->fill($request->formSchedule());
        $schedule->save();

        flash('Successful! Schedule updated.')->success();

        return redirect(route('schedules.index'));
    }

    public function destroy(Schedule $schedule)
    {
        $this->authorize('update', $schedule);

        $relationships = $this->checkRelationships($schedule, [
            'appointment' => 'appointments',
        ]);

        if (empty($relationships)) {
            $schedule->delete();

            flash('Successful! schedule deleted')->success();
        } else {
            flash('Warning! Deletion '.$schedule->day.' not allowed!')->warning();
        }

        return redirect(route('schedules.index'));
    }
}
