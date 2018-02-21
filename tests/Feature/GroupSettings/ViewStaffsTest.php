<?php

namespace Tests\Feature\GroupSettings;

use Tests\TestCase;
use App\Models\Setting\Group\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewStaffsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();
    }

    /** @test */
    public function unauthorized_users_cannot_access_staff_on_group_settings_section()
    {
        $group = create(Group::class);

        $this->signIn()
            ->get('/'.$group->slug.'/settings/staffs')
            ->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_access_staff_on_group_setttings_section()
    {
        $group = create(Group::class);

        $this->signInOwner();
        $this->signInAdministrator();

        $this->get('/'.$group->slug.'/settings/staffs')
            ->assertStatus(201);
    }
}
