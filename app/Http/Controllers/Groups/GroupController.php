<?php

namespace App\Http\Controllers\Groups;

use App\Models\Setting\Group\Group;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function appointment(Group $group)
    {
        $appointments = $group->appointments()->get();

        return view('groups.appointment', [
            'group'        => $group,
            'appointments' => $appointments->load('user'),
        ]);
    }
}
