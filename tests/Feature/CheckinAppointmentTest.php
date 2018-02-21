<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckinAppointmentTest extends TestCase
{
    use RefreshDatabase;

    protected $group;
    protected $adminGroup;
    protected $adminCounter;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();

        $this->group = create('App\Models\Setting\Group\Group');
        $this->adminGroup = create('App\Models\Setting\Staff\Staff', ['group_id' => $this->group->id]);
        $this->adminCounter = create('App\Models\Setting\Staff\Staff', ['group_id' => $this->group->id]);
    }

    /** @test */
    public function unauthorized_users_should_be_not_able_to_access_group_appointments()
    {
        $this->get('/'.$this->group->slug.'/appointments')->assertRedirect('/login');

        $this->signIn()->get('/'.$this->group->slug.'/appointments')->assertStatus(403);

        $this->signInOwner()->get('/'.$this->group->slug.'/appointments')->assertStatus(403);

        $this->signInAdministrator()->get('/'.$this->group->slug.'/appointments')->assertStatus(403);
    }

    /** @test */
    public function authorized_users_should_be_able_to_access_their_group_appointments()
    {
        $this->signInAdminGroup($this->adminGroup->user)
            ->get('/'.$this->group->slug.'/appointments')
            ->assertStatus(200);

        $this->signInAdminCounter($this->adminCounter->user)
            ->get('/'.$this->group->slug.'/appointments')
            ->assertStatus(200);
    }

    /** @test */
    public function unauthorized_users_should_be_not_able_to_checkin_group_appointments()
    {
        $appointment = create('App\Models\Appointment\Appointment');

        $this->get('/'.$this->group->slug.'/appointments/'.$appointment->token)
            ->assertRedirect('/login');

        $this->signIn()
            ->patch('/'.$this->group->slug.'/appointments/'.$appointment->token, [])
            ->assertStatus(403);

        $this->signInOwner()
            ->patch('/'.$this->group->slug.'/appointments/'.$appointment->token, [])
            ->assertStatus(403);

        $this->signInAdministrator()
        ->patch('/'.$this->group->slug.'/appointments/'.$appointment->token, [])
        ->assertStatus(403);
    }

    /** @test */
    public function authorized_users_should_be_able_to_checkin_their_group_appointments()
    {
        $appointment = create('App\Models\Appointment\Appointment');

        $this->signInAdminGroup($this->adminGroup->user);
        $this->signInAdminCounter($this->adminCounter->user);

        $this->patch('/'.$this->group->slug.'/appointments/'.$appointment->token, ['status' => 'checked']);

        $this->assertDatabaseHas('appointments', ['status' => 'checked']);
    }
}
