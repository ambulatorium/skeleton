<?php

namespace App\Http\Controllers;

use App\Models\Appointment\Appointment;
use App\Models\MedicalRecord\MedicalRecord;
use App\User;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PeopleController extends Controller
{

    public function profile()
    {
        return view('people.profile');
    }

    public function updateProfile(UpdateProfileRequest $request, User $user)
    {
        $user->patient()->update($request->formProfile());

        flash('Successful! Your profile updated')->important();
        
        return redirect()->back();
    }

    public function appointment()
    {
        $appointments = Appointment::with('doctor.polyclinic')
            ->where([
                ['user_id', Auth::user()->id],
                ['status', 'active']
            ])->get();
        
        return view('people.appointment', compact('appointments'));
    }

    public function medicalRecord()
    {
        $medicalRecords = MedicalRecord::with('user', 'appointment')->where('patient_id', Auth::user()->id)->get();

        return view('people.medical-record', compact('medicalRecords'));
    }

    public function account()
    {
        return view('people.account');
    }

}
