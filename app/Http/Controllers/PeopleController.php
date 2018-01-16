<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Models\Setting\Staff\Staff;
use App\Models\Appointment\Appointment;

class PeopleController extends Controller
{
    public function profile()
    {
        $appointments = Appointment::with('schedule.doctor')->where('user_id', auth()->id())->get();

        if ($staff = Staff::where('user_id', auth()->id())->first()) {
            return view('people.profile', compact('appointments', 'staff'));
        }

        return view('people.profile', compact('appointments'));
    }

    public function appointment(Appointment $appointment)
    {
        return view('people.appointment', compact('appointment'));
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
}
