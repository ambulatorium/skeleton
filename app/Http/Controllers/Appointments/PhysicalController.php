<?php

namespace App\Http\Controllers\Appointments;

use Illuminate\Http\Request;
use App\Models\Doctor\Doctor;
use Illuminate\Support\Carbon;
use App\Models\Doctor\Schedule;
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

        // @further cleanup
        $request_date = Carbon::parse(request('date'));
        $min_date = today()->addDays(1); //@further addDays value from setting

        //@further addDays value from setting
        if ($request_date < $min_date || $request_date > $min_date->addDays(7)) {
            abort(404);
        }

        $schedules = $this->getSchedules();
        $locations = Group::all();
        $specialities = Speciality::all();

        return view('appointments.physical.index', compact('schedules', 'locations', 'specialities'));
    }

    public function create(Doctor $doctor, Request $request)
    {
        if ($request->has('date')) {
            $this->validate($request, ['date' => 'date']);

            // @further cleanup
            $request_date = Carbon::parse(request('date'));
            $min_date = today()->addDays(1); //@further addDays value from setting

            //@further addDays value from setting and cleanup
            if ($request_date < $min_date || $request_date > $min_date->addDays(7)) {
                abort(404);
            }

            $schedule = $doctor->schedule()->where('day', \Carbon\Carbon::parse($request->get('date'))->format('l'))->firstOrFail();

            $start_time = strtotime($schedule->start_time);
            $end_time = strtotime($schedule->end_time);

            return view('appointments.physical.create', compact('doctor', 'schedule', 'start_time', 'end_time'));
        }

        $schedules = $doctor->schedule()->get();

        return view('appointments.physical.show', compact('doctor', 'schedules'));
    }

    public function store(AppointmentRequest $request)
    {
        auth()->user()->schedulingAppointment(
            new Appointment($request->formAppointment())
        );

        // @further send notification to doctor and patient

        flash('Successful! Physcial appointment scheduled')->success();

        return redirect('/people');
    }

    protected function getSchedules()
    {
        return Schedule::whereHas('doctor.speciality', function ($q) {
            $q->where('name', request('speciality'));
        })
        ->whereHas('doctor.group', function ($q) {
            $q->where('health_care_name', request('location'));
        })
        ->with('doctor.group', 'doctor.user')->where('day', \Carbon\Carbon::parse(request('date'))->format('l'))
        ->get();
    }
}
