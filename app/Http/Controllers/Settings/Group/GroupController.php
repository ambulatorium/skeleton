<?php

namespace App\Http\Controllers\Settings\Group;

use App\Http\Controllers\Controller;
use App\Models\Setting\Group\Group;
use Illuminate\Http\Request;
use App\Http\Requests\GroupRequest;


class GroupController extends Controller
{

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

        flash('Successful! New health care created')->success();

        return redirect('/settings/groups');
    }

    public function show($id)
    {
        //
    }

    public function edit(Group $group)
    {
        return view('settings.group.edit', compact('group'));
    }

    public function update(GroupRequest $request, Group $group)
    {
        $group->fill($request->formGroup());
        $group->save();

        flash('Successful! Health Care Updated')->success();

        return redirect('/settings/groups');
    }

    public function destroy($id)
    {
        //
    }
}
