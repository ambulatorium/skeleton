<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Models\Doctor\Doctor;
use App\Models\Polyclinic\Polyclinic;
use App\Models\Appointment\Appointment;
use App\Http\Requests\DoctorRequest;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view-doctors|add-doctors|edit-doctors|delete-doctors']);
    }

    public function index()
    {
        $doctors = Doctor::with('polyclinic')->get();
        
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        $polyclinics = Polyclinic::all();
        
        return view('doctors.create', compact('polyclinics'));
    }

    public function store(DoctorRequest $request)
    {
        Doctor::create($request->formDoctor());

        flash('Successful! New doctor created')->important();

        return redirect('/doctors');
    }

    public function show(Doctor $doctor)
    {
        return view('doctors.show', [
            'doctor' => $doctor->load('polyclinic'),
            'schedules' => $doctor->schedule()->get(),
        ]);
    }

    public function appointments(Doctor $doctor)
    {
        $appointments = Appointment::where([
            ['doctor_id', '=', $doctor->id],
            ['status', '=', 'confirmed']
        ])->get();

        return view('doctors.appointments.index', compact('appointments'));
    }

    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', [
            'doctor' => $doctor,
            'polyclinics' => Polyclinic::latest()->get()
        ]);
    }

    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $doctor->fill($request->formDoctor());
        $doctor->save();

        flash('Successful! Doctor updated')->important();

        return redirect('/doctors/'.$doctor->id);
    }
    
    public function destroy(Doctor $doctor)
    {
        //
    }
}
