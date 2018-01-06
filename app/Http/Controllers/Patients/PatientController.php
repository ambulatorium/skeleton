<?php

namespace App\Http\Controllers\Patients;

use App\Models\Patient\Patient;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:owner']);
    }

    public function index()
    {
        return view('patients.index', [
            'patients' => Patient::with('user')->paginate(8),
        ]);
    }
}
