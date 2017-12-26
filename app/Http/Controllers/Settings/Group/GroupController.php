<?php

namespace App\Http\Controllers\Settings\Group;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Setting\Group\Group;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:owner|admin']);
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

        flash('Successful! New health care created')->success();

        return redirect('/settings/groups');
    }

    public function show(Group $group)
    {
        $doctors = $group->load('doctor.user', 'doctor.speciality')
                         ->doctor()->where('status', 1)
                         ->get();

        return view('groups.show', [
            'group'   => $group,
            'doctors' => $doctors,
        ]);
    }

    public function update(GroupRequest $request, Group $group)
    {
        $group->fill($request->formGroup());
        $group->save();

        flash('Successful! Health Care Updated')->success();
        return redirect('/'.$group->slug.'/settings/profile');
    }

    public function destroy(Group $group)
    {
        $relationships = $this->checkRelationships($group, [
            'doctor' => 'doctor',
        ]);

        if(empty($relationships)) {
            $group->delete();

            flash('Successful! The group deleted')->success();
        } else {
            flash('Warning! Deletion of '.$group->health_care_name.' not allowed!')->warning();
        }

        return redirect('/settings/groups');
    }
}
