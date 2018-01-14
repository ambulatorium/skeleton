<?php

namespace App\Http\Controllers\Patients;

use Illuminate\Http\Request;
use App\Models\Doctor\Schedule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient\HealthHistory;
use App\Models\Appointment\Appointment;
use App\Http\Requests\HealthHistoryRequest;

class HealthHistoryController extends Controller
{
    public function index()
    {
        $health_histories = HealthHistory::with('user')->where('user_id', Auth::user()->id)->get();

        return view('people.health_history.index', compact('health_histories'));
    }

    public function show(HealthHistory $health_history)
    {
        # code...
    }

    public function create(Appointment $appointment)
    {
        $today = today()->format('Y-m-d');

        $appointment = $appointment->where([
                                        ['date', $today],
                                        ['doctor_id', Auth::user()->doctor->id],
                                    ])
                                    ->firstOrFail();

        return view('people.schedule.show-appointment', compact('appointment'));
    }

    public function store(HealthHistoryRequest $request, Appointment $appointment)
    {
        if (HealthHistory::create($request->formHealthHistory())) {
            $appointment->delete();
        } else {
            flash('Error! something went wrong')->error();

            return redirect()->back();
        }

        flash('Successful! treatments and consultation saved.')->success();

        return redirect('/people/doctor/appointments');
    }
}
