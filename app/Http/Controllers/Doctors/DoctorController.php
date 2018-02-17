<?php

namespace App\Http\Controllers\Doctors;

use App\Models\Doctor\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting\Speciality\Speciality;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:doctor']);
    }

    public function edit()
    {
        if (! $user = Auth::user()->doctor()->first()) {
            abort(404);
        }

        return view('users.settings.doctor_profile', [
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
}
