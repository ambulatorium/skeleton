<?php

namespace App\Http\Controllers\Groups;

use App\Models\Setting\Staff\Role;
use App\Models\Setting\Group\Group;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:owner|administrator|admin-group']);
    }

    public function profile(Group $group)
    {
        $this->authorize('update', $group);

        return view('groups.settings.profile', compact('group'));
    }
}
