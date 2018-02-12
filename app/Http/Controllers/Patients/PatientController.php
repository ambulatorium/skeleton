<?php

namespace App\Http\Controllers\Patients;

use App\Models\Patient\Patient;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientFormRequest;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::where('user_id', auth()->id())->get();

        return view('users.settings.patient_forms.index', compact('patients'));
    }

    public function create()
    {
        return view('users.settings.patient_forms.create');
    }

    public function store(PatientFormRequest $request)
    {
        Patient::create($request->patientRegistrationForm());

        flash('Successful! your patient form submitted')->success();

        return redirect(route('patient-forms.index'));
    }

    public function show()
    {
        return redirect(route('patient-forms.index'));
    }

    public function edit(Patient $patient_form)
    {
        $this->authorize('update', $patient_form);

        return view('users.settings.patient_forms.edit', compact('patient_form'));
    }

    public function update(PatientFormRequest $request, Patient $patient_form)
    {
        $this->authorize('update', $patient_form);

        $patient_form->update($request->patientRegistrationForm());

        flash('Successful! your patient form updated')->success();

        return redirect(route('patient-forms.index'));
    }

    public function destroy(Patient $patient_form)
    {
        $this->authorize('update', $patient_form);

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

        return redirect(route('patient-forms.index'));
    }
}
