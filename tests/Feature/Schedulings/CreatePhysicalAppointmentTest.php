<?php

namespace Tests\Feature\Schedulings;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePhysicalAppointmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_should_be_login_before_scheduling_a_physical_appointment()
    {
        $requestDate = today()->addDays(1);

        $this->withExceptionHandling()
            ->post('/scheduling/physical-appointment/some-token?date='.$requestDate, [])
            ->assertRedirect('/login');
    }

    /** @test */
    public function a_date_should_required()
    {
        $this->withExceptionHandling()->signIn();

        $doctorSchedule = create('App\Models\Doctor\Schedule');
        $appointment = make('App\Models\Appointment\Appointment', ['date' => null]);

        $this->post('/scheduling/physical-appointment/'.$doctorSchedule->token, $appointment->toArray())
            ->assertSessionHasErrors('date');
    }

    /** @test */
    public function a_patient_form_should_required()
    {
        $this->withExceptionHandling()->signIn();

        $doctorSchedule = create('App\Models\Doctor\Schedule');
        $appointment = make('App\Models\Appointment\Appointment', [
            'patient_id'  => null,
            'user_id'     => create('App\User')->id,
        ]);

        $this->post('/scheduling/physical-appointment/'.$doctorSchedule->token, $appointment->toArray())
            ->assertSessionHasErrors('patient_id');
    }

    /** @test */
    public function a_patient_current_condition_should_required()
    {
        $this->withExceptionHandling()->signIn();

        $doctorSchedule = create('App\Models\Doctor\Schedule');
        $appointment = make('App\Models\Appointment\Appointment', ['patient_condition' => null]);

        $this->post('/scheduling/physical-appointment/'.$doctorSchedule->token, $appointment->toArray())
            ->assertSessionHasErrors('patient_condition');
    }

    /** @test */
    public function a_user_can_schedule_a_physical_appointment()
    {
        $requestDate = today()->addDays(1);

        $this->signIn();

        $doctorSchedule = create('App\Models\Doctor\Schedule', [
            'day'       => $requestDate->format('l'),
        ]);

        $appointment = make('App\Models\Appointment\Appointment', [
            'schedule_id' => $doctorSchedule->id,
            'user_id'     => $doctorSchedule->doctor->user->id,
            'doctor_id'   => $doctorSchedule->doctor_id,
            'date'        => $requestDate,
        ]);

        $response = $this->post('/scheduling/physical-appointment/'.$doctorSchedule->token, $appointment->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($doctorSchedule->doctor->full_name)
            ->assertSee(Carbon::parse($appointment->preferred_time)->format('g:ia'));
    }
}
