<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InboxTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_should_be_login_before_access_inbox()
    {
        $this->withExceptionHandling()
            ->get('/user/inbox')
            ->assertRedirect('/login');
    }

    /** @test */
    public function authorized_user_can_see_its_appointments()
    {
        $this->signIn();

        $patient_form = create('App\Models\Patient\Patient', ['user_id' => auth()->id()]);
        $appointment = create('App\Models\Appointment\Appointment', ['patient_id' => $patient_form->id]);

        $this->get('/user/inbox')
            ->assertSee($appointment->doctor->full_name)
            ->assertSee(Carbon::parse($appointment->date)->format('l, d F Y'))
            ->assertSee(Carbon::parse($appointment->preferred_time)->format('H:ia'))
            ->assertSee($appointment->created_at->diffForHumans());
    }

    /** @test */
    public function authorized_user_cannot_see_all_details_appointment()
    {
        $this->signIn();

        $appointment = create('App\Models\Appointment\Appointment');

        $this->get('/user/inbox/'.$appointment->token)
            ->assertStatus(403);
    }

    /** @test */
    public function authorized_user_can_see_details_its_appointment()
    {
        $this->signIn();

        $patient_form = create('App\Models\Patient\Patient', ['user_id' => auth()->id()]);
        $appointment = create('App\Models\Appointment\Appointment', ['patient_id' => $patient_form->id]);

        $this->get('/user/inbox/'.$appointment->token)
            ->assertSee($appointment->doctor->group->name)
            ->assertSee($appointment->token);
    }

    /** @test */
    public function authorized_users_can_not_cancel_an_appointment_that_is_not_their_own()
    {
        $this->signIn();

        $appointment = create('App\Models\Appointment\Appointment');

        $this->delete('/user/inbox/'.$appointment->token)->assertStatus(403);

        $this->assertDatabaseHas('appointments', ['id' => $appointment->id]);
    }

    /** @test */
    public function authorized_users_should_be_able_to_cancel_their_appointment()
    {
        $this->signIn();

        $patient_form = create('App\Models\Patient\Patient', ['user_id' => auth()->id()]);
        $appointment = create('App\Models\Appointment\Appointment', ['patient_id' => $patient_form->id]);

        $this->delete('/user/inbox/'.$appointment->token);

        $this->assertDatabaseMissing('appointments', ['id' => $appointment->id]);
    }
}
