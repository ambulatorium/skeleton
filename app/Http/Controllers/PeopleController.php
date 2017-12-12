<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Appointment\Appointment;
use App\Models\MedicalRecord\MedicalRecord;
use App\User;
use Illuminate\Support\Facades\Auth;

class PeopleController extends Controller
{
    public function profile()
    {
        $appointments = Appointment::with('doctor.polyclinic', 'doctor.group')
            ->where([
                ['user_id', Auth::user()->id],
            ])->get();

        return view('people.profile', compact('appointments'));
    }

    public function settingProfile()
    {
        return view('people.settings.profile');
    }

    public function updateProfile(UpdateProfileRequest $request, User $user)
    {
        $user->patient()->update($request->formProfile());
        $user->fill(['name' => request('name')]);
        $user->save();

        flash('Successful! Your profile updated')->success();

        return redirect()->back();
    }

    public function settingAccount()
    {
        return view('people.settings.account');
    }
}
