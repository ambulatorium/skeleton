<?php

namespace App\Http\Controllers\Patients;

use App\Http\Controllers\Controller;
use App\Models\Patient\HealthHistory;

class HealthHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:doctor'])->except('index', 'show');
    }

    public function index()
    {
        $health_histories = HealthHistory::with('patient')->where('user_id', auth()->id())->get();

        return view('people.health_history.index', compact('health_histories'));
    }

    public function show($id)
    {
        $health_history = HealthHistory::where([
                                            ['id', $id],
                                            ['user_id', auth()->id()],
                                        ])->firstOrFail();

        return view('people.health_history.show', compact('health_history'));
    }
}
