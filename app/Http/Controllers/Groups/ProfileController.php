<?php

namespace App\Http\Controllers\Groups;

use Illuminate\Http\Request;
use App\Models\Setting\Group\Group;
use App\Http\Requests\GroupRequest;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:owner|administrator|admin-group'])->except('show');
    }

    public function show(Group $group)
    {
        $doctors = $group->doctors()->where('is_active', true)->get();

        return view('groups.show', [
            'group'   => $group,
            'doctors' => $doctors->load('speciality'),
        ]);
    }

    public function edit(Group $group)
    {
        $this->authorize('update', $group);

        return view('groups.settings.profile', compact('group'));
    }

    public function update(Group $group, GroupRequest $request)
    {
        $this->authorize('update', $group);

        $group->fill($request->formGroup());
        $group->save();

        flash('Successful! profile updated')->success();

        return redirect('/'.$group->slug.'/settings/profile');
    }
}
