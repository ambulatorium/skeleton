<?php

namespace App\Http\Controllers\Settings\Staffs;

use App\Http\Controllers\Controller;
use App\Models\Patient\Patient;
use App\Models\Setting\Staff\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:owner']);
    }

    public function index()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->whereNotIn('name', ['patient', 'nurse']);
        })->get();

        return view('settings.staffs.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::whereNotIn('name', ['patient', 'nurse'])->get();

        return view('settings.staffs.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|max:120',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'roles'    => 'required|min:1',
         ]);

        // hash password
        $request->merge(['password' => bcrypt($request->get('password'))]);

        if ($user = User::create($request->except('roles'))) {
            $user->assignRole($request->get('roles'));

            $user->patient = Patient::create([
                'user_id'       => $user->id,
                'register_from' => 'online',
            ]);

            flash('Successful! Staff added')->success();

            return redirect()->route('staffs.index');
        }

        flash('Warning! Unable to create staff')->warning();

        return redirect()->route('staffs.index');
    }

    public function show($id)
    {
        return redirect('/settings/staffs');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::whereNotIn('name', ['patient', 'nurse'])->get();

        return view('settings.staffs.edit', [
            'user'  => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  => 'required|max:120',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required|min:1',
        ]);

        $user = User::findOrFail($id);
        $user->fill($request->except('roles', 'password'));

        if ($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }

        $user->save();
        $roles = $request->get('roles');

        if (isset($roles)) {
            $user->roles()->sync($roles);
        } else {
            $user->roles()->detach();
        }

        flash('Successful! Staff updated')->success();

        return redirect()->route('staffs.index');
    }

    public function destroy($id)
    {
        if (Auth::user()->id == $id) {
            flash('Warning! Deletion of currently logged in user is not allowed :(')->warning();

            return redirect()->back();
        }

        if (User::findOrFail($id)->delete()) {
            flash('Successful! Staff successfully delete')->success();

            return redirect()->back();
        }

        flash('Warning! Staff not deleted')->warning();

        return redirect()->back();
    }
}
