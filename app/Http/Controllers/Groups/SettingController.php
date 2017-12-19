<?php

namespace App\Http\Controllers\Groups;

use Illuminate\Http\Request;
use App\Models\Setting\Group\Group;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function profile(Group $group)
    {
        return view('groups.settings.profile', compact('group'));
    }

    public function staff(Group $group)
    {
        return view('groups.settings.staff', compact('group'));
    }
}
