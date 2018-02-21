<?php

namespace Tests\Feature\AppSettings;

use Tests\TestCase;
use App\Models\Invitation;
use App\Mail\SendInvitation;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageStaffsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();
    }

    /** @test */
    public function guests_cannot_access_staffs_on_app_settings_section()
    {
        $this->get(route('staffs.index'))
            ->assertRedirect('/login');

        $this->get(route('staffs.create'))
            ->assertRedirect('/login');
    }

    /** @test */
    public function unauthorized_users_cannot_access_staffs_on_app_settings_section()
    {
        $this->signInAdministrator();
        $this->signInAdminGroup();
        $this->signIn();

        $this->get(route('staffs.index'))
            ->assertStatus(response::HTTP_FORBIDDEN);

        $this->get(route('staffs.create'))
            ->assertStatus(response::HTTP_FORBIDDEN);

        $this->post(route('staffs.store'))
            ->assertStatus(response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function authorized_users_can_access_staffs_on_app_settings_section()
    {
        $staffsInGroup = create('App\Models\Setting\Staff\Staff');

        $this->signInOwner();

        $this->get(route('staffs.index'))
            ->assertStatus(response::HTTP_OK)
            ->assertDontSee($staffsInGroup->user->name);

        $this->get(route('staffs.create'))
            ->assertStatus(response::HTTP_OK);
    }

    /** @test */
    public function authorized_user_can_invite_staff()
    {
        $this->signInOwner();

        Mail::fake();

        $this->post(route('staffs.store'), [
            'email' => 'john@example.com',
            'role'  => 'administrator',
        ]);

        Mail::assertSent(SendInvitation::class);
    }

    /** @test */
    public function staff_candidate_can_accept_their_invitation_link()
    {
        $staff = create(Invitation::class, [
            'email' => 'john@example.com',
            'role'  => 'administrator',
        ]);

        $invitation = Invitation::whereEmail('john@example.com')->first();

        $this->assertNotNull($invitation->token);
        $this->assertNotNull($invitation->email);

        $this->get(route('accept', ['token' => $invitation->token]))
            ->assertStatus(201);
    }

    /** @test */
    public function staff_candidate_can_join_with_their_invitation_link()
    {
        $invitation = create(Invitation::class, [
            'email' => 'john@example.com',
            'role'  => 'administrator',
        ]);

        $this->post(route('join', ['token' => $invitation->token]), [
            'name'                  => 'john',
            'email'                 => $invitation->email,
            'role'                  => $invitation->role,
            'password'              => 'foobar',
            'password_confirmation' => 'foobar',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
        $this->assertDatabaseHas('roles', ['name' => 'administrator']);
        $this->assertDatabaseMissing('invitations', ['email' => 'john@example.com']);
    }

    /** @test */
    public function staff_candidate_access_with_their_invalid_invitation_link()
    {
        $this->get(route('accept', ['token' => 'invalid']))
            ->assertStatus(404);
    }
}
