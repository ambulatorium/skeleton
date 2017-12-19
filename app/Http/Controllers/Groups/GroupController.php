<?php

namespace App\Http\Controllers\Groups;

use Illuminate\Http\Request;
use App\Models\Doctor\Doctor;
use App\Models\Setting\Group\Group;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function doctor(Doctor $doctor, Group $group)
    {
        return view('groups.doctor.profile', compact('doctor', 'group'));
    }
}
