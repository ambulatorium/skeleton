<?php

namespace App\Http\Controllers\Appointments;

use Illuminate\Http\Request;
use App\Models\Doctor\Doctor;
use Illuminate\Support\Carbon;
use App\Models\Doctor\Schedule;
use App\Models\Patient\Patient;
use App\Models\Setting\Group\Group;
use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;
use App\Http\Requests\AppointmentRequest;
use App\Models\Setting\Speciality\Speciality;

class PhysicalController extends Controller
{
    public function index()
    {
        $this->validate(request(), [
            'location'   => 'required|string',
            'speciality' => 'required|string',
            'date'       => 'required|date',
        ]);

        $this->requestDate();

        return view('appointments.physical.index', [
            'schedules'    => $this->getSchedules(),
            'locations'    => Group::all(),
            'specialities' => Speciality::all(),
        ]);
    }

    public function create(Schedule $schedule)
    {
        $this->requestDate();

        if ($schedule->day !== \Carbon\Carbon::parse(request('date'))->format('l')) {
            abort(404);
        }

        return view('appointments.physical.create', [
            'schedule'     => $schedule,
            'patients'     => Patient::where('user_id', auth()->id())->get(),
            'appointments' => Appointment::where('date', request('date'))->get(),
            'start_time'   => strtotime($schedule->start_time),
            'end_time'     => strtotime($schedule->end_time),
        ]);
    }

    public function store(Schedule $schedule, AppointmentRequest $request)
    {
        if (auth()->id() === $schedule->doctor->user_id) {
            flash('Error! you can not schedule an appointment with yourself.')->error();

            return redirect()->back();
        }

        if ($appointment = Appointment::where('patient_id', $request->patient_id)->first()) {
            flash('Error! '.$appointment->patient->full_name.' already has an appointment schedule.')->error();

            return redirect()->back();
        }

        auth()->user()->schedulingAppointment(
            new Appointment($request->formAppointment())
        );

        flash('Successful! Physcial appointment scheduled')->success();

        return redirect('/people/inbox');
    }

    protected function getSchedules()
    {
        return Schedule::whereHas('doctor.speciality', function ($q) {
            $q->where('name', request('speciality'));
        })
        ->whereHas('doctor.group', function ($q) {
            $q->where('health_care_name', request('location'));
        })
        ->with('doctor')->where('day', \Carbon\Carbon::parse(request('date'))->format('l'))
        ->get();
    }

    protected function requestDate()
    {
        $this->validate(request(), ['date' => 'required|date']);

        $request_date = Carbon::parse(request('date'));
        $min_date = today()->addDays(1);

        if ($request_date < $min_date || $request_date > $min_date->addDays(7)) {
            abort(404);
        }
    }
}
