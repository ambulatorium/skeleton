<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckoutAppointmentTest extends TestCase
{
    use RefreshDatabase;

    protected $appointment;
    protected $doctor;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();

        $this->appointment = create('App\Models\Appointment\Appointment');
        $this->doctor = create('App\Models\Doctor\Doctor');
    }

    /** @test */
    public function unauthorized_users_should_be_not_able_to_access_outpatients_appointments()
    {
        $this->get('/user/outpatients')->assertRedirect('/login');

        $this->signIn()->get('/user/outpatients')->assertStatus(403);

        $this->signInOwner()->get('/user/outpatients')->assertStatus(403);

        $this->signInAdministrator()->get('/user/outpatients')->assertStatus(403);
    }

    /** @test */
    public function authorized_users_should_be_able_to_access_their_outpatients_appointments()
    {
        $appointment = $this->outpatientsAppointment();

        $this->get('/user/outpatients')
            ->assertStatus(200)
            ->assertSee($appointment->token)
            ->assertSee($appointment->patient->full_name);
    }

    /** @test */
    public function unauthorized_users_should_be_not_able_to_checkout_outpatients_appointments()
    {
        $this->signInDoctor($this->doctor->user);

        $this->get('/user/outpatients/'.$this->appointment->token)->assertStatus(404);
    }

    /** @test */
    public function authorized_users_should_be_able_to_checkout_their_outpatients_appointments()
    {
        $appointment = $this->outpatientsAppointment();

        $healthHistory = make('App\Models\Patient\HealthHistory', [
            'patient_id' => $appointment->patient_id,
            'user_id'    => $appointment->user_id,
            'doctor_id'  => $appointment->doctor_id,
        ]);

        $this->post('/user/outpatients/'.$appointment->token, $healthHistory->toArray());

        $this->assertDatabaseHas('health_histories', ['doctor_id' => $appointment->doctor_id]);
        $this->assertDatabaseHas('health_histories', ['user_id' => $appointment->user_id]);
        $this->assertDatabaseHas('health_histories', ['patient_id' => $appointment->patient_id]);

        $this->assertDatabaseMissing('appointments', ['id' => $appointment->id]);
    }

    protected function outpatientsAppointment()
    {
        $this->signInDoctor($this->doctor->user);

        $schedule = create('App\Models\Doctor\Schedule', [
            'day'       => today()->format('l'),
            'doctor_id' => $this->doctor->id,
        ]);

        $appointment = create('App\Models\Appointment\Appointment', [
            'schedule_id' => $schedule->id,
            'date'        => today()->format('Y-m-d'),
            'status'      => 'checked',
        ]);

        return $appointment;
    }
}
