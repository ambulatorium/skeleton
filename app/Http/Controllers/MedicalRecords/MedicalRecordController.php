<?php

namespace App\Http\Controllers\MedicalRecords;

use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;
use App\Models\MedicalRecord\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:add-medicalrecords']);
    }

    public function save(Request $request)
    {
        $this->validate(request(), [
            'doctor_diagnosis' => 'required|max:160',
            'doctor_actions'   => 'required|max:160',
        ]);

        $appointment = Appointment::findOrFail($request->get('appointment_id'));
        $appointment->fill(['status' => 'medicalRecord']);
        $appointment->save();

        MedicalRecord::create([
            'user_id'          => $request->get('user_id'),
            'patient_id'       => $request->get('patient_id'),
            'appointment_id'   => $request->get('appointment_id'),
            'doctor_diagnosis' => $request->get('doctor_diagnosis'),
            'doctor_actions'   => $request->get('doctor_actions'),
        ]);

        flash('Successful! Medical Record Saved')->important();

        return redirect('/doctors/'.$request->get('doctor_id'));
    }
}
