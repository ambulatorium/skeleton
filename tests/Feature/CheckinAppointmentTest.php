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
    public function authorized_users_should_be_able_to_filter_by_token_their_group_appointments()
    {
        $filterAppointment = create('App\Models\Appointment\Appointment', ['group_id' => $this->group->id]);
        $dontFilterAppointment = create('App\Models\Appointment\Appointment');

        $this->signInAdminGroup($this->adminGroup->user);
        $this->signInAdminCounter($this->adminCounter->user);

        $this->get('/'.$this->group->slug.'/appointments'.'?token='.$filterAppointment->token)
            ->assertSee($filterAppointment->token)
            ->assertDontSee($dontFilterAppointment->token);
    }

    /** @test */
    public function authorized_users_should_be_able_to_filter_by_date_their_group_appointments()
    {
        $date = today()->addDays(1)->format('Y-m-d');

        $filterAppointment = create('App\Models\Appointment\Appointment', [
            'group_id' => $this->group->id,
            'date' => today()->addDays(1)->format('Y-m-d'),
        ]);

        $dontFilterAppointment = create('App\Models\Appointment\Appointment', ['group_id' => $this->group->id]);

        $this->signInAdminGroup($this->adminGroup->user);
        $this->signInAdminCounter($this->adminCounter->user);

        $this->get('/'.$this->group->slug.'/appointments'.'?date='.$date)
            ->assertSee($filterAppointment->token)
            ->assertSee($filterAppointment->date)
            ->assertDontSee($dontFilterAppointment->token);
    }

    /** @test */
    public function unauthorized_users_should_be_not_able_to_checkin_group_appointments()
    {
        $appointment = create('App\Models\Appointment\Appointment');

        $this->get('/'.$appointment->group->slug.'/appointments/'.$appointment->token)
            ->assertRedirect('/login');

        $this->signIn()
            ->patch('/'.$appointment->group->slug.'/appointments/'.$appointment->token, [])
            ->assertStatus(403);

        $this->signInOwner()
            ->patch('/'.$appointment->group->slug.'/appointments/'.$appointment->token, [])
            ->assertStatus(403);

        $this->signInAdministrator()
            ->patch('/'.$appointment->group->slug.'/appointments/'.$appointment->token, [])
            ->assertStatus(403);

        $this->signInAdminGroup($this->adminGroup->user)
            ->patch('/'.$appointment->group->slug.'/appointments/'.$appointment->token, [])
            ->assertStatus(403);

        $this->signInAdminCounter($this->adminCounter->user)
            ->patch('/'.$appointment->group->slug.'/appointments/'.$appointment->token, [])
            ->assertStatus(403);       
    }

    /** @test */
    public function patient_should_be_verified_before_checkin_appointment()
    {
        $appointment = create('App\Models\Appointment\Appointment', ['group_id' => $this->group->id]);

        $this->signInAdminGroup($this->adminGroup->user);
        $this->signInAdminCounter($this->adminCounter->user);

        $this->patch('/'.$this->group->slug.'/appointments/'.$appointment->token, ['status' => 'checked'])
            ->assertStatus(500);

        $this->assertDatabaseHas('appointments', ['status' => 'scheduled']);
    }

    /** @test */
    public function authorized_users_should_be_able_to_verified_patient()
    {
        $appointment = create('App\Models\Appointment\Appointment', ['group_id' => $this->group->id]);

        $this->signInAdminGroup($this->adminGroup->user);
        $this->signInAdminCounter($this->adminCounter->user);

        $this->patch('/'.$this->group->slug.'/appointments/'.$appointment->token.'/'.$appointment->patient->id, [
            'form_name'       => 'Changed',
            'full_name'       => 'Changed',
            'dob'             => '1993-09-13',
            'gender'          => 'male',
            'address'         => 'Changed',
            'city'            => 'Changed',
            'state'           => 'Changed',
            'zip_code'        => '17510',
            'home_phone'      => '0000000000000',
            'cell_phone'      => '0000000000000',
            'marital_status'  => 'single',
            'is_verified'     => true,
        ]);

        $this->assertDatabaseHas('patients', ['is_verified' => true]);
    }

    /** @test */
    public function authorized_users_should_be_able_to_checkin_their_group_appointments()
    {
        $patient = create('App\Models\Patient\Patient', ['is_verified' => true]);
        $appointment = create('App\Models\Appointment\Appointment', [
            'patient_id' => $patient->id,
            'group_id' => $this->group->id,
        ]);

        $this->signInAdminGroup($this->adminGroup->user);
        $this->signInAdminCounter($this->adminCounter->user);

        $this->patch('/'.$this->group->slug.'/appointments/'.$appointment->token, ['status' => 'checked']);
            
        $this->assertDatabaseHas('appointments', ['status' => 'checked']);   
    }
}
