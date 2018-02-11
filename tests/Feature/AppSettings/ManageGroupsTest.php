<?php

namespace Tests\Feature\AppSettings;

use Tests\TestCase;
use App\Models\Setting\Group\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageGroupsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();
    }

    /** @test */
    public function guests_cannot_access_groups_on_app_settings_section()
    {
        $this->get('/settings/groups')
            ->assertRedirect('/login');

        $this->get('/settings/groups/create')
            ->assertRedirect('/login');
    }

    /** @test */
    public function unauthorized_users_cannot_access_groups_on_app_settings_section()
    {
        $this->signIn()
            ->get('/settings/groups')
            ->assertStatus(403);

        $this->signIn()
            ->get('/settings/groups/create')
            ->assertStatus(403);

        $this->signIn()
            ->post('/settings/groups')
            ->assertStatus(403);
    }
    
    /** @test */
    public function authorized_users_can_access_groups_on_app_settings_section()
    {
        $this->signInOwner()
            ->get('/settings/groups')
            ->assertStatus(200);

        $this->signInAdministrator()
            ->get('/settings/groups')
            ->assertStatus(200);
    }

    /** @test */
    public function authorized_users_can_create_a_group()
    {
        $response = $this->createGroup([
            'name'        => 'reliqui hospital',
            'country'     => 'example country.',
            'city'        => 'example city.',
            'address'     => 'example address.',
        ]);

        $this->get($response->headers->get('Location'))
            ->assertSee('reliqui hospital')
            ->assertSee('example address.');
    }

    /** @test */
    public function a_group_requires_name()
    {
        $this->createGroup(['name' => null])
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_group_requires_country()
    {
        $this->createGroup(['country' => null])
            ->assertSessionHasErrors('country');
    }

    /** @test */
    public function a_group_requires_city()
    {
        $this->createGroup(['city' => null])
            ->assertSessionHasErrors('city');
    }

    /** @test */
    public function a_group_requires_address()
    {
        $this->createGroup(['address' => null])
            ->assertSessionHasErrors('address');
    }
    
    /** @test */
    public function a_group_requires_a_unique_slug()
    {
        $this->signInOwner();
        $this->signInAdministrator();

        $group = create(Group::class, ['slug' => 'reliqui-hospital-jakarta']);

        $this->assertEquals($group->slug, 'reliqui-hospital-jakarta');
    }

    /** @test */
    public function unauthorized_users_cannot_delete_a_group()
    {
        $group = create(Group::class);

        $this->delete($group->appSetting())->assertRedirect('/login');

        $this->signIn();
        $this->delete($group->appSetting())->assertStatus(403);
    }

    /** @test */
    public function authorized_users_cannot_delete_group_that_have_doctors()
    {
        $this->signInOwner();
        $this->signInAdministrator();

        $group = create('App\Models\Setting\Group\Group');
        $doctor = create('App\Models\Doctor\Doctor', ['group_id' => $group->id]);

        $this->delete($group->appSetting());

        $this->assertDatabaseHas('groups', ['id' => $group->id]);
        $this->assertDatabaseHas('doctors', ['group_id' => $group->id]);
    }

    /** @test */
    public function authorized_users_can_delete_a_group()
    {
        $this->signInOwner();
        $this->signInAdministrator();

        $group = create('App\Models\Setting\Group\Group');

        $this->delete($group->appSetting());

        $this->assertDatabaseMissing('groups', ['id' => $group->id]);
    }

    protected function createGroup($overrides = [])
    {
        $this->signInOwner();
        $this->signInAdministrator();

        $group = make(Group::class, $overrides);

        return $this->post('/settings/groups', $group->toArray());
    }
}
