<?php

namespace App\Http\Controllers\Doctors;

use App\Models\Doctor\Doctor;
use App\Models\Setting\Group\Group;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view-doctors|delete-doctors']);
    }

    public function index()
    {
        $doctors = Doctor::with('speciality', 'group', 'user')->where('status', 1)->paginate(10);

        return view('doctors.index', compact('doctors'));
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
        $appointments = $doctor->appointment()->where('status', 'confirmed')->get();

        return view('doctors.appointments.index', compact('appointments'));
    }
}
