<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Invitation;
use App\Mail\SendInvitation;
use Illuminate\Http\Request;
use App\Models\Doctor\Doctor;
use App\Models\Patient\Patient;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    public function send(Request $request)
    {
        $this->validate(request(), [
            'email'    => 'required|string|email|max:255|unique:invitations',
            'group_id' => 'required',
            'role'     => 'required',
        ]);

        do { $token = str_random(); }
        //check if the token already exists and if it does, try again
        while (Invitation::where('token', $token)->first());

        $invite = Invitation::create([
            'email'    => $request->get('email'),
            'group_id' => $request->get('group_id'),
            'role'     => $request->get('role'),
            'token'    => $token,
        ]);

        Mail::to($request->get('email'))->send(new SendInvitation($invite));

        flash('Successful! Invitation sent.')->success();
        return redirect()->back();
    }

    public function accept($token)
    {
        if (!$invite = Invitation::where('token', $token)->first()) {
            abort(404);
        }

        return view('auth.invitation', compact('invite'));
    }

    public function join($token)
    {
        $this->validate(request(), [
            'name'     => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (!$invite = Invitation::where('token', $token)->first()) {
            abort(500);
        }

        $user = User::create([
            'name'     => request('name'),
            'email'    => $invite->email,
            'password' => bcrypt(request('password')),
        ]);

        $user->patient = Patient::create([
            'user_id'       => $user->id,
            'register_from' => 'invited',
        ]);

        if ($invite->role === 'doctor') {

            $user->doctor = Doctor::create([
                'user_id'  => $user->id,
                'group_id' => $invite->group_id,
            ]);

        }
        $user->assignRole($invite->role);
        $invite->delete();

        flash('Successful! Invitation Accepted. Now you can login with your credentials.')->success();
        return redirect('/login');
    }

    public function destroy(Invitation $invitation)
    {
        $invitation->delete();

        flash('Successful! Invitation deleted.')->success();
        return redirect()->back();
    }
}
