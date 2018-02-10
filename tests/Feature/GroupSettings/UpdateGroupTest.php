<?php

namespace Tests\Feature\GroupSettings;

use Tests\TestCase;
use App\Models\Setting\Group\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateGroupTest extends TestCase
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
    public function guests_cannot_access_on_group_settings_profile_section()
    {
        $this->get('/'.$this->group->slug.'/settings/profile')
            ->assertRedirect('/login');
    }

    /** @test */
    public function unauthorized_users_cannot_access_on_group_settings_profile_section()
    {
        $this->signIn()
            ->get('/'.$this->group->slug.'/settings/profile')
            ->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_updated_group()
    {
        $this->signInOwner();
        $this->signInAdministrator();

        $group = create(Group::class);
        
        $this->patch($group->appSetting(), [
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
