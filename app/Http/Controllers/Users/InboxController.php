<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;

class InboxController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('doctor')->where('user_id', auth()->id())->get();

        return view('users.inbox.index', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        return view('users.inbox.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $appointment->delete();

        flash('Successful! appointment canceled')->success();

        return redirect('/user/inbox');
    }
}
