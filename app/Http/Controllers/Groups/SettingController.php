<?php

namespace App\Http\Controllers\Groups;

use Illuminate\Http\Request;
use App\Models\Setting\Staff\Role;
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

    public function invitation(Group $group)
    {
        $invitations = $group->invitation()->get();
        $roles       = Role::whereNotIn('name', ['owner', 'administrator', 'patient'])->get();

        return view('groups.settings.invitation', [
            'group'       => $group,
            'invitations' => $invitations,
            'roles'       => $roles,
        ]);
    }
}
