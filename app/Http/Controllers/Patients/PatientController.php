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

        return redirect('/people/inbox');
    }

    public function show()
    {
        return redirect('/people/settings/patient-form');
    }

    public function edit(Patient $patient_form)
    {
        $patient = $patient_form->where([
                                ['user_id', auth()->id()],
                                ['id', $patient_form->id],
                            ])
                            ->firstOrFail();

        return view('people.settings.patient.edit', compact('patient'));
    }

    public function update(PatientFormRequest $request, Patient $patient_form)
    {
        $patient_form->update($request->patientRegistrationForm());

        flash('Successful! your patient form updated')->success();

        return redirect('/people/settings/patient-form');
    }

    public function destroy(Patient $patient_form)
    {
        $relationships = $this->checkRelationships($patient_form, [
            'appointment'   => 'appointment',
            'healthhistory' => 'healthHistory',
        ]);

        if (empty($relationships)) {
            $patient_form->delete();

            flash('Successful! patient form deleted')->success();
        } else {
            flash('Warning! deletion '.$patient_form->form_name.' not allowed.')->warning();
        }

        return redirect('/people/settings/patient-form');
    }
}
