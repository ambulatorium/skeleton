<?php

namespace App\Http\Controllers\Doctors;

use App\Models\Doctor\Doctor;
use App\Models\Setting\Group\Group;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Models\Appointment\Appointment;
use App\Models\Setting\Speciality\Speciality;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view-doctors|add-doctors|edit-doctors|delete-doctors']);
    }

    public function index()
    {
        return view('doctors.index', [
            'doctors' => Doctor::with('speciality', 'group')->paginate(10),
        ]);
    }

    public function create()
    {
        $specialities = Speciality::all();
        $groups = Group::all();

        return view('doctors.create', [
            'specialities' => $specialities,
            'groups'      => $groups,
        ]);
    }

    public function store(DoctorRequest $request)
    {
        Doctor::create($request->formDoctor());

        flash('Successful! New doctor created')->success();

        return redirect('/doctors');
    }

    public function show(Group $group, Doctor $doctor)
    {
        return view('doctors.show', [
            'doctor'    => $doctor,
            'group'     => $group,
            'schedules' => $doctor->load('schedule')->schedule()->get(),
        ]);
    }

    public function appointments(Doctor $doctor)
    {
        // $appointments = Appointment::where([
        //     ['doctor_id', '=', $doctor->id],
        //     ['status', '=', 'confirmed'],
        // ])->get();

        $appointments = $doctor->appointment()->where('status', 'confirmed')->get();

        return view('doctors.appointments.index', compact('appointments'));
    }

    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', [
            'doctor'      => $doctor,
            'specialities' => Speciality::latest()->get(),
            'groups'      => Group::latest()->get(),
        ]);
    }

    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $doctor->fill($request->formDoctor());
        $doctor->save();

        flash('Successful! Doctor updated.')->success();

        return redirect('/doctors/'.$doctor->id);
    }

    public function destroy(Doctor $doctor)
    {
        $relationships = $this->checkRelationships($doctor, [
            'schedule'    => 'schedule',
            'appointment' => 'appointment',
        ]);

        if (empty($relationships)) {
            $doctor->delete();

            flash('Successful! Doctor deleted.')->success();
        } else {
            flash('Warning! Deletion '.$doctor->name.' not allowed.')->warning();
        }

        return redirect('/doctors');
    }
}
