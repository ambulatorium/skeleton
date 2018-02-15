<?php

namespace App\Http\Controllers\Schedulings;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Doctor\Schedule;
use App\Models\Patient\Patient;
use App\Models\Setting\Group\Group;
use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;
use App\Models\Setting\Speciality\Speciality;
use App\Http\Requests\PhysicalAppointmentRequest;

class PhysicalAppointmentController extends Controller
{
    public function index()
    {
        $this->validate(request(), [
            'location'   => 'required|string',
            'speciality' => 'required|string',
            'date'       => 'required|date',
        ]);

        $this->confirmDate();

        return view('schedulings.physical_appointment.index', [
            'schedules'    => $this->getDoctorsSchedule(),
            'locations'    => Group::all(),
            'specialities' => Speciality::all(),
        ]);
    }

    public function create(Schedule $schedule)
    {
        $this->confirmDate();

        if ($schedule->day !== \Carbon\Carbon::parse(request('date'))->format('l')) {
            abort(404);
        }

        return view('schedulings.physical_appointment.create', [
            'schedule'     => $schedule,
            'patients'     => Patient::where('user_id', auth()->id())->get(),
            'appointments' => Appointment::where('date', request('date'))->get(),
            'start_time'   => strtotime($schedule->start_time),
            'end_time'     => strtotime($schedule->end_time),
        ]);
    }

    public function store(Schedule $schedule, PhysicalAppointmentRequest $request)
    {
        if (auth()->id() === $schedule->doctor->user_id) {
            flash('Error! you can not schedule an appointment with yourself.')->error();

            return redirect()->back();
        }

        Appointment::create($request->formPhysicalAppointment());

        flash('Successful! Physical appointment scheduled')->success();

        return redirect('/user/inbox');
    }

    private function getDoctorsSchedule()
    {
        return Schedule::whereHas('doctor.speciality', function ($q) {
            $q->where('name', request('speciality'));
        })
        ->whereHas('doctor.group', function ($q) {
            $q->where('name', request('location'));
        })
        ->with('doctor')->where('day', \Carbon\Carbon::parse(request('date'))->format('l'))
        ->get();
    }

    private function confirmDate()
    {
        $this->validate(request(), ['date' => 'required|date']);

        $request_date = Carbon::parse(request('date'));
        $min_date = today()->addDays(1);

        if ($request_date < $min_date || $request_date > $min_date->addDays(6)) {
            abort(404);
        }
    }
}
