<?php

namespace App\Http\Controllers;

use Reliqui\Ambulatory\ReliquiHealthcareLocation;

class WelcomeController extends Controller
{
    public function show()
    {
        $locations = ReliquiHealthcareLocation::all();

        return view('welcome', compact('locations', 'schedules'));
    }
}
