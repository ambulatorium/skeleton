<?php

namespace App\Http\Controllers;

use App\Models\Doctor\Doctor;
use App\Models\Setting\Group\Group;
use App\Models\Setting\Speciality\Speciality;

class HomeController extends Controller
{
    public function home()
    {
        return view('home', [
            'specialities' => Speciality::all(),
            'locations'    => Group::all(),
        ]);
    }

    public function explore()
    {
        return view('explore', [
            'doctors'       => Doctor::with('speciality')->get(),
            'groups'        => Group::all(),
            'specialities'  => Speciality::all(),
        ]);
    }
}
