<?php

namespace App\Http\Controllers\Patients;

use App\Models\Patient\Patient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PatientFormRequest;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::where('user_id', Auth::user()->id)->get();

        return view('people.settings.patient.index', compact('patients'));
    }

    public function create()
    {
        return view('people.settings.patient.create');
    }

    public function store(PatientFormRequest $request)
    {
        Patient::create($request->patientRegistrationForm());

        flash('Successful! your patient form submitted')->success();

        return redirect('/people');
    }

    public function edit(Patient $patient)
    {
        $patient = $patient->where('user_id', auth()->id())->firstOrFail();

        return view('people.settings.patient.edit', compact('patient'));
    }

    public function update(PatientFormRequest $request, Patient $patient)
    {
        $patient->update($request->patientRegistrationForm());

        flash('Successful! your patient form updated')->success();

        return redirect('/people/settings/patient-form');
    }
}
