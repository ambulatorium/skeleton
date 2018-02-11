<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Models\Appointment\Appointment;

class PeopleController extends Controller
{
    public function inbox()
    {
        $appointments = Appointment::with('doctor')->where('user_id', auth()->id())->get();

        return view('people.inbox', compact('appointments'));
    }
}
