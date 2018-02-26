<?php

namespace App\Http\Controllers;

use App\Models\Setting\Group\Group;

class HomeController extends Controller
{
    public function home()
    {
        return view('home', [
            'locations'    => Group::all(),
        ]);
    }
}
