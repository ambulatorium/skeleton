<?php

namespace Tests\Feature\GroupSettings;

use Tests\TestCase;
use App\Models\Setting\Group\Group;
use App\Models\Setting\Staff\Staff;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GroupProfileTest extends TestCase
{
    use RefreshDatabase;

    protected $group;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();

        $this->group = create(Group::class);
    }

    /** @test */
    public function guests_should_not_be_able_to_access_on_group_settings_profile_section()
    {
        $this->get('/'.$this->group->slug.'/settings/profile')
            ->assertRedirect('/login');
    }

    /** @test */
    public function unauthorized_users_should_not_be_able_to_access_on_group_settings_profile_section()
    {
        $this->signIn()
            ->get('/'.$this->group->slug.'/settings/profile')
            ->assertStatus(403);
    }

    /** @test */
    public function authorized_owner_or_administrator_should_be_able_to_update_group()
    {
        $this->signInOwner();
        $this->signInAdministrator();

        $group = create(Group::class);

        $this->patch('/'.$group->slug.'/settings/profile', [
            'name'    => 'Changed',
            'country' => 'Changed country.',
            'city'    => 'Changed city.',
            'address' => 'Changed address.',
        ]);

        tap($group->fresh(), function ($group) {
            $this->assertEquals('Changed', $group->name);
            $this->assertEquals('Changed country.', $group->country);
            $this->assertEquals('Changed city.', $group->city);
            $this->assertEquals('Changed address.', $group->address);
        });
    }

    /** @test */
    public function authorized_admin_group_should_not_be_able_to_update_which_is_not_their_group()
    {
        $group = create(Group::class);
        $staff = create(Staff::class, ['group_id' => $group->id]);

        $this->signInAdminGroup($staff->user);

        $this->patch('/'.$this->group->slug.'/settings/profile', [
            'name'    => 'Changed',
            'country' => 'Changed country.',
            'city'    => 'Changed city.',
            'address' => 'Changed address.',
        ])->assertStatus(403);
    }

    /** @test */
    public function authorized_admin_group_should_be_able_to_update_their_group()
    {
        $group = create(Group::class);
        $staff = create(Staff::class, ['group_id' => $group->id]);

        $this->signInAdminGroup($staff->user);

        $this->patch('/'.$group->slug.'/settings/profile', [
            'name'    => 'Changed',
            'country' => 'Changed country.',
            'city'    => 'Changed city.',
            'address' => 'Changed address.',
        ]);

        tap($group->fresh(), function ($group) {
            $this->assertEquals('Changed', $group->name);
            $this->assertEquals('Changed country.', $group->country);
            $this->assertEquals('Changed city.', $group->city);
            $this->assertEquals('Changed address.', $group->address);
        });
    }
}
