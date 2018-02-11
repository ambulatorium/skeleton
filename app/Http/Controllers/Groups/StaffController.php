<?php

namespace App\Http\Controllers\Groups;

use App\Models\Setting\Group\Group;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:owner|administrator|admin-group']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Group $group
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group)
    {
        $this->authorize('staff', $group);

        $staffs = $group->staffs()->get();

        return view('groups.settings.staff.index', [
            'group' => $group,
            'staffs' => $staffs->load('user'),
        ]);
    }
}
