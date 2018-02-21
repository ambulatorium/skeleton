<?php

namespace Tests\Feature\GroupSettings;

use Tests\TestCase;
use App\Models\Invitation;
use App\Mail\SendInvitation;
use App\Models\Setting\Group\Group;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InviteStaffsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();
    }

    /** @test */
    public function unauthorized_users_cannot_access_invitations_on_group_settings_section()
    {
        $group = create(Group::class);

        $this->signIn()
            ->get('/'.$group->slug.'/settings/invitations')
            ->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_access_invitations_on_group_setttings_section()
    {
        $group = create(Group::class);

        $this->signInOwner();
        $this->signInAdministrator();

        $this->get('/'.$group->slug.'/settings/invitations')
            ->assertStatus(201);
    }

    /** @test */
    public function unauthorized_users_cannot_invite_staffs()
    {
        $group = create(Group::class);

        $this->signIn();

        Mail::fake();

        $this->post('/'.$group->slug.'/settings/invitations', [
            'email'    => 'john@example.com',
            'role'     => 'admin-group',
            'group_id' => $group->id,
        ])->assertStatus(403);

        $this->assertDatabaseMissing('invitations', ['group_id' => $group->id]);
    }

    /** @test */
    public function authorized_users_can_invite_staffs()
    {
        $group = create(Group::class);

        $this->signInOwner();
        $this->signInAdministrator();

        Mail::fake();

        $this->post('/'.$group->slug.'/settings/invitations', [
            'email'    => 'john@example.com',
            'role'     => 'admin-group',
            'group_id' => $group->id,
        ]);

        Mail::assertSent(SendInvitation::class);

        $this->assertDatabaseHas('invitations', ['group_id' => $group->id]);
    }

    /** @test */
    public function staff_candidate_in_group_can_accept_their_invitation_link()
    {
        $staff = create(Invitation::class, [
            'email'    => 'john@example.com',
            'role'     => 'admin-group',
            'group_id' => '1',
        ]);

        $invitation = Invitation::whereEmail('john@example.com')->first();

        $this->assertNotNull($invitation->token);
        $this->assertNotNull($invitation->email);
        $this->assertNotNull($invitation->group_id);

        $this->get(route('accept', ['token' => $invitation->token]))
            ->assertStatus(201);
    }

    /** @test */
    public function staff_candidate_in_group_can_join_with_their_invitation_link()
    {
        $group = create(Group::class);

        $invitation = create(Invitation::class, [
            'email'    => 'john@example.com',
            'role'     => 'admin-group',
            'group_id' => $group->id,
        ]);

        $this->post(route('join', ['token' => $invitation->token]), [
            'name'                  => 'john',
            'email'                 => $invitation->email,
            'role'                  => $invitation->role,
            'group_id'              => $invitation->group_id,
            'password'              => 'foobar',
            'password_confirmation' => 'foobar',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
        $this->assertDatabaseHas('roles', ['name' => 'admin-group']);
        $this->assertDatabaseMissing('invitations', ['email' => 'john@example.com']);
    }

    /** @test */
    public function staff_candidate_in_group_access_with_their_invalid_invitation_link()
    {
        $this->get(route('accept', ['token' => 'invalid']))
            ->assertStatus(404);
    }
}
