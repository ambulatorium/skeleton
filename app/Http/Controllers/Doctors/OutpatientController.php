<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient\HealthHistory;
use App\Models\Appointment\Appointment;
use App\Http\Requests\HealthHistoryRequest;

class OutpatientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:doctor']);
    }

    public function index()
    {
        $today = today()->format('Y-m-d');

        $appointments = Appointment::with('patient')
            ->where([
                ['status', 'checked'],
                ['doctor_id', Auth::user()->doctor->id],
                ['date', $today],
            ])
            ->orderBy('preferred_time', 'asc')
            ->paginate(10);

        return view('users.outpatients.index', compact('appointments'));
    }

    public function create(Appointment $appointment)
    {
        $appointment = $this->getAppointment($appointment);

        $healthHistories = $this->getHealthHistories($appointment);

        return view('users.outpatients.create', compact('appointment', 'healthHistories'));
    }

    public function store(HealthHistoryRequest $request, Appointment $appointment)
    {
        $this->authorize('checkout', $appointment);

        if (HealthHistory::create($request->formHealthHistory())) {
            $appointment->delete();
        } else {
            flash('Error! something went wrong')->error();

            return redirect()->back();
        }

        flash('Successful! treatments and consultation saved.')->success();

        return redirect('/user/outpatients');
    }

    private function getAppointment(Appointment $appointment)
    {
        $today = today()->format('Y-m-d');

        $appointment = $appointment->where([
            ['date', $today],
            ['doctor_id', Auth::user()->doctor->id],
            ['status', 'checked'],
        ]);

        return $appointment->firstOrFail();
    }

    private function getHealthHistories(Appointment $appointment)
    {
        $HealthHistories = HealthHistory::with('doctor')->where('patient_id', $appointment->patient_id);

        return $HealthHistories->get();
    }
}
