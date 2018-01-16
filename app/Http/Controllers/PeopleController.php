<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Models\Doctor\Doctor;
use App\Models\Setting\Staff\Staff;
use App\Http\Requests\DoctorRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment\Appointment;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Setting\Speciality\Speciality;

class PeopleController extends Controller
{
    public function profile()
    {
        $appointments = Appointment::with('schedule.doctor.user')->where('user_id', Auth::user()->id)->get();

        if ($staff = Staff::where('user_id', Auth::user()->id)->first()) {
            return view('people.profile', compact('appointments', 'staff'));
        }

        return view('people.profile', compact('appointments'));
    }

    public function appointment(Appointment $appointment)
    {
        return view('people.appointment', compact('appointment'));
    }

    public function settingProfile()
    {
        return view('people.settings.profile');
    }

    public function settingAccount()
    {
        return view('people.settings.account');
    }

    public function updateAccount(Request $request, User $user)
    {
        $this->validate($request, ['name' => 'required|string|max:255']);

        $user->fill($request->except('password'));

        if ($request->get('password')) {
            $this->validate($request, ['password' => 'required|string|min:6|confirmed']);

            $user->password = bcrypt($request->get('password'));
        }

        $user->save();

        flash('Successful! Your account updated.')->success();

        return redirect('/people/settings/account');
    }

    public function settingDoctor()
    {
        if (! $user = Auth::user()->doctor()->first()) {
            abort(404);
        }

        return view('people.settings.doctor', [
            'doctorProfile' => $user,
            'specialities'  => Speciality::all(),
        ]);
    }

    public function updateDoctor(DoctorRequest $request, Doctor $doctor)
    {
        $doctor->fill($request->formDoctor());
        $doctor->update();

        flash('Successful! Doctor Profile Updated.')->success();

        return redirect()->back();
    }
}
