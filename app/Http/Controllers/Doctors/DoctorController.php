<?php

namespace App\Http\Controllers\Doctors;

use App\Models\Doctor\Doctor;
use App\Filters\DoctorFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting\Speciality\Speciality;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:doctor'])->except(['index', 'show']);
    }

    public function index(Speciality $speciality, DoctorFilters $filters)
    {
        $doctors = $this->getDoctors($speciality, $filters);

        return view('doctors.index', compact('doctors'));
    }

    public function show($speciality, Doctor $doctor)
    {
        $schedules = $doctor->schedules()->get();

        return view('doctors.show', compact('doctor', 'schedules'));
    }

    public function edit()
    {
        if (! $user = Auth::user()->doctor()->first()) {
            abort(404);
        }

        return view('users.settings.doctor_profile', [
            'doctorProfile' => $user,
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

    protected function getDoctors(Speciality $speciality, DoctorFilters $filters)
    {
        $doctors = Doctor::with('speciality', 'group')->latest()->filter($filters);

        if ($speciality->exists) {
            $doctors->where('speciality_id', $speciality->id);
        }

        return $doctors->paginate(12);
    }
}
