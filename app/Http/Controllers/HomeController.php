<?php

namespace App\Http\Controllers;

use App\Models\Setting\Group\Group;
use App\Models\Setting\Speciality\Speciality;

class HomeController extends Controller
{
    public function home()
    {
        // if (Auth::check()) {
        //     return redirect('/people');
        // }
        
        return view('home', [
            'specialities' => Speciality::all(),
            'locations'    => Group::all(),
        ]);
    }
}
