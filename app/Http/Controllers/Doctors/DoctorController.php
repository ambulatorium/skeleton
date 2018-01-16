<?php

namespace App\Http\Controllers\Doctors;

use App\Models\Doctor\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DoctorRequest;
use App\Models\Setting\Speciality\Speciality;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('speciality', 'group', 'user')->paginate(10);

        return view('doctors.index', compact('doctors'));
    }

    public function editProfile()
    {
        if (!$user = Auth::user()->doctor()->first()) {
            abort(404);
        }

        return view('people.settings.doctor', [
            'doctorProfile' => $user,
            'specialities' => Speciality::all(),
        ]);
    }

    public function updateProfile(DoctorRequest $request, Doctor $doctor)
    {
        $doctor->fill($request->formDoctor());
        $doctor->update();

        flash('Successful! Doctor Profile Updated.')->success();

        return redirect()->back();
    }
}
