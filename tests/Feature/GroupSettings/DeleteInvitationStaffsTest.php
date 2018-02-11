<?php

namespace Tests\Feature\GroupSettings;

use Tests\TestCase;
use App\Models\Invitation;
use App\Models\Setting\Group\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteInvitationStaffsTest extends TestCase
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

        $this->get('/'.$group->slug.'/settings/invitations')
            ->assertRedirect('/login');

        $this->signIn()
            ->get('/'.$group->slug.'/settings/invitations')
            ->assertStatus(403);
    }

    /** @test */
    public function unauthorized_users_cannot_delete_invitations()
    {
        $group = create(Group::class);
        $staff = create(Invitation::class, ['group_id' => $group->id]);

        $this->delete('/'.$group->slug.'/settings/invitations/'.$group->id)->assertRedirect('/login');

        $this->signIn();
        $this->delete('/'.$group->slug.'/settings/invitations/'.$group->id)->assertStatus(403);

        $this->assertDatabaseHas('invitations', ['group_id' => $group->id]);
    }

    /** @test */
    public function authorized_users_can_delete_invitations()
    {
        $group = create(Group::class);
        $staff = create(Invitation::class, ['group_id' => $group->id]);

        $this->signInOwner();
        $this->signInAdministrator();

        $this->delete('/'.$group->slug.'/settings/invitations/'.$group->id);

        $this->assertDatabaseMissing('invitations', ['group_id' => $group->id]);
    }
}
