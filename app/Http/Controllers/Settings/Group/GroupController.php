<?php

namespace App\Http\Controllers\Settings\Group;

use App\Http\Requests\GroupRequest;
use App\Models\Setting\Group\Group;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:owner|administrator']);
    }

    public function index()
    {
        $groups = Group::paginate(5);

        return view('settings.group.index', compact('groups'));
    }

    public function create()
    {
        return view('settings.group.create');
    }

    public function store(GroupRequest $request)
    {
        Group::create($request->formGroup());

        flash('Successful! New group created')->success();

        return redirect('/settings/groups');
    }

    public function destroy(Group $group)
    {
        $relationships = $this->checkRelationships($group, [
            'doctor' => 'doctors',
        ]);

        if (empty($relationships)) {
            $group->delete();

            flash('Successful! The group deleted')->success();
        } else {
            flash('Warning! Deletion of '.$group->name.' not allowed!')->warning();
        }

        return redirect('/settings/groups');
    }
}
