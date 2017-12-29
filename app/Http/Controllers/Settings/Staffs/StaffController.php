<?php

namespace App\Http\Controllers\Settings\Staffs;

use App\User;
use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Mail\SendInvitation;
use App\Models\Patient\Patient;
use App\Models\Setting\Staff\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\InvitationRequest;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:owner']);
    }

    public function index()
    {
        $users = User::with('roles')->whereHas('roles', function ($q) {
            $q->whereIn('name', ['owner', 'administrator',]);
        })->get();

        return view('settings.staffs.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::whereIn('name', ['owner', 'administrator'])->get();

        return view('settings.staffs.create', ['roles' => $roles]);
    }

    public function store(InvitationRequest $request)
    {
        $invite = Invitation::create($request->formInvitation('email', 'role', 'token'));

        Mail::to($request->get('email'))->send(new SendInvitation($invite));

        flash('Successful! Invitation sent.')->success();
        return redirect()->route('staffs.index');
    }

    public function show()
    {
        return redirect('/settings/staffs');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::whereIn('name', ['owner', 'administrator', 'patient'])->get();

        return view('settings.staffs.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['roles' => 'required|min:1']);

        if (Auth::user()->id == $id) {
            flash('Warning! Updation of currently logged in user is not allowed :(')->warning();

            return redirect()->back();
        }

        $user = User::findOrFail($id);
        $user->fill($request->except('roles'));
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

    public function destroy()
    {
        return redirect('/settings/staffs');
    }
}
