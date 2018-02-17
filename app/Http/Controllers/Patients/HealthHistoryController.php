<?php

namespace App\Http\Controllers\Patients;

use App\Http\Controllers\Controller;
use App\Models\Patient\HealthHistory;

class HealthHistoryController extends Controller
{
    public function index()
    {
        $healthHistories = HealthHistory::with('patient')->where('user_id', auth()->id())->get();

        return view('users.health_history.index', compact('healthHistories'));
    }

    public function show(HealthHistory $healthHistory)
    {
        $this->authorize('view', $healthHistory);

        return view('users.health_history.show', compact('healthHistory'));
    }
}
