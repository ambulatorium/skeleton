<?php

namespace App\Http\Controllers\Doctors;

use App\Models\Doctor\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment\Appointment;
use App\Models\Setting\Speciality\Speciality;

class DoctorController extends Controller
{
    public function index()
    {
        $this->authorize('view-doctors');

        $doctors = Doctor::with('speciality', 'group')->paginate(10);

        return view('doctors.index', compact('doctors'));
    }

    public function edit()
    {
        if (! $user = Auth::user()->doctor()->first()) {
            abort(404);
        }

        return view('people.settings.doctor', [
            'doctorProfile' => $user,
            'specialities' => Speciality::all(),
        ]);
    }

    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $this->authorize('update', $doctor);

        $doctor->fill($request->formDoctor());
        $doctor->update();

        flash('Successful! Doctor Profile Updated.')->success();

        return redirect()->back();
    }

    public function appointment()
    {
        $today = today()->format('Y-m-d');

        $appointments = Appointment::where([
                            ['date', $today],
                            ['status', 'confirmed'],
                            ['doctor_id', Auth::user()->doctor->id],
                        ])
                        ->paginate(1);

        return view('people.schedule.appointment', compact('appointments'));
    }
}
