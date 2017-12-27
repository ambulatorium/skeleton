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

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:invitations',
            'role'  => 'required|min:1',
         ]);

        // temporary. invite where user not exist.
        if (User::where('email', request('email'))->first()) {
            flash('Warning! Email already exists.')->warning();

            return redirect()->back();
        }

        do { $token = str_random(); }
        //check if the token already exists and if it does, try again
        while (Invitation::where('token', $token)->first());

        $invite = Invitation::create([
            'email'    => $request->get('email'),
            'role'     => $request->get('role'),
            'token'    => $token,
        ]);

        Mail::to($request->get('email'))->send(new SendInvitation($invite));

        flash('Successful! Invitation sent.')->success();
        return redirect()->route('staffs.index');
    }

    public function show($id)
    {
        return redirect('/settings/staffs');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::whereIn('name', ['owner', 'administrator', 'patient'])->get();

        return view('settings.staffs.edit', [
            'user'  => $user,
            'roles' => $roles,
        ]);
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

    public function destroy($id)
    {
        return redirect('/settings/staffs');
    }
}
