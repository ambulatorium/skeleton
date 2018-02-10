<?php

namespace App\Http\Controllers\Groups;

use App\Models\Invitation;
use App\Mail\SendInvitation;
use Illuminate\Http\Request;
use App\Models\Setting\Staff\Role;
use App\Models\Setting\Group\Group;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\InvitationRequest;

class InvitationController extends Controller
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
        $this->authorize('invitation', $group);

        $invitations = $group->invitations()->get();
        $roles = Role::whereNotIn('name', ['owner', 'administrator', 'patient'])->get();

        return view('groups.settings.staff.invitation.index', [
            'group'       => $group,
            'invitations' => $invitations,
            'roles'       => $roles,
        ]);
    }

    /**
     * Store and sent invitation.
     *
     * @param InvitationRequest $request
     * @return void
     */
    public function store(InvitationRequest $request, Group $group)
    {
        $this->authorize('invitation', $group);

        $invite = Invitation::create($request->formInvitation());

        Mail::to($request->get('email'))->send(new SendInvitation($invite));

        flash('Successful! Invitation sent.')->success();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @param Invitation $invitation
     * @return void
     */
    public function destroy(Group $group, Invitation $invitation)
    {
        $this->authorize('invitation', $group);

        $invitation->delete();

        flash('Successful! Invitation deleted.')->success();

        return redirect()->back();
    }
}
