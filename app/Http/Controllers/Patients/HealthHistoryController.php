<?php

namespace App\Http\Controllers\Patients;

use App\Models\Doctor\Schedule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient\HealthHistory;
use App\Models\Appointment\Appointment;
use App\Http\Requests\HealthHistoryRequest;

class HealthHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:doctor'])->except('index', 'show');
    }

    public function index()
    {
        $health_histories = HealthHistory::with('patient')->where('user_id', auth()->id())->get();

        return view('people.health_history.index', compact('health_histories'));
    }

    public function show($id)
    {
        $health_history = HealthHistory::where([
                                            ['id', $id],
                                            ['user_id', auth()->id()],
                                        ])->firstOrFail();

        return view('people.health_history.show', compact('health_history'));
    }

    public function create(Appointment $appointment)
    {
        $today = today()->format('Y-m-d');

        $appointment = $appointment->where([
                                        ['date', $today],
                                        ['doctor_id', Auth::user()->doctor->id],
                                        ['status', 'checked'],
                                    ])
                                    ->firstOrFail();

        $health_histories = HealthHistory::with('doctor')->where('patient_id', $appointment->patient_id)->get();

        return view('people.outpatients.create', compact('appointment', 'health_histories'));
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

        return redirect('/people/outpatients');
    }
}
