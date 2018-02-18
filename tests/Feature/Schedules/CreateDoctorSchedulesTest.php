<?php

namespace Tests\Feature\UserSettings;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateDoctorSchedulesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();
    }

    /** @test */
    public function guests_may_not_create_schedules()
    {
        $this->get(route('schedules.index'))
            ->assertRedirect('/login');

        $this->get(route('schedules.store'))
            ->assertRedirect('/login');
    }

    /** @test */
    public function unauthorized_users_cannot_create_schedules()
    {
        $this->signIn();

        $this->get(route('schedules.index'))
            ->assertStatus(403);

        $this->get(route('schedules.store'))
            ->assertStatus(403);
    }

    /** @test */
    public function authorized_users_has_a_profile_doctor_must_be_active_before_create_schedules()
    {
        $doctor = factory('App\Models\Doctor\Doctor')->states('notactive')->create();

        $this->signInDoctor($doctor->user);

        $schedule = make('App\Models\Doctor\Schedule');

        $this->post(route('schedules.store'), $schedule->toArray())
            ->assertRedirect(route('schedules.index'));
    }

    /** @test */
    public function authorized_users_has_a_profile_doctor_can_create_new_schedules()
    {
        $response = $this->submitSchedule([
            'day'        => 'Tuesday',
            'start_time' => '10:00:00',
            'end_time'   => '15:00:00',
        ]);

        $this->get($response->headers->get('Location'))
            ->assertSee('Tuesday')
            ->assertSee('10:00am')
            ->assertSee('15:00pm');
    }

    /** @test */
    public function a_schedule_require_a_day()
    {
        $this->submitSchedule(['day' => ''])
            ->assertSessionHasErrors('day');
    }

    /** @test */
    public function a_schedule_require_a_start_time()
    {
        $this->submitSchedule(['start_time' => ''])
            ->assertSessionHasErrors('start_time');
    }

    /** @test */
    public function a_schedule_require_a_end_time()
    {
        $this->submitSchedule(['end_time' => ''])
            ->assertSessionHasErrors('end_time');
    }

    /** @test */
    public function a_schedule_require_a_estimated_service_time()
    {
        $this->submitSchedule(['estimated_service_time' => ''])
            ->assertSessionHasErrors('estimated_service_time');
    }

    /** @test */
    public function a_schedule_require_a_estimated_price_service()
    {
        $this->submitSchedule(['estimated_price_service' => ''])
            ->assertSessionHasErrors('estimated_price_service');
    }

    /** @test */
    public function a_schedule_require_available_boolean()
    {
        $this->submitSchedule(['is_available' => ''])
            ->assertSessionHasErrors('is_available');
    }

    /** @test */
    public function unauthorized_users_cannot_delete_schedules()
    {
        $schedule = create('App\Models\Doctor\Schedule');

        $this->delete(route('schedules.destroy', $schedule->id))->assertRedirect('/login');

        $this->signIn();
        $this->delete(route('schedules.destroy', $schedule->token))->assertStatus(403);

        $this->assertDatabaseHas('schedules', ['id' => $schedule->id]);
    }

    /** @test */
    public function authorized_users_cannot_delete_their_own_schedule_that_have_appointment()
    {
        $doctor = create('App\Models\Doctor\Doctor');

        $this->signInDoctor($doctor->user);

        $schedule = create('App\Models\Doctor\Schedule', ['doctor_id' => Auth::user()->doctor->id]);
        $appointment = create('App\Models\Appointment\Appointment', ['schedule_id' => $schedule->id]);

        $this->delete(route('schedules.destroy', $schedule->token))
            ->assertRedirect(route('schedules.index'));

        $this->assertDatabaseHas('schedules', ['id' => $schedule->id]);
        $this->assertDatabaseHas('appointments', ['id' => $appointment->id]);
    }

    /** @test */
    public function authorized_users_can_delete_their_own_schedule()
    {
        $doctor = create('App\Models\Doctor\Doctor');

        $this->signInDoctor($doctor->user);

        $schedule = create('App\Models\Doctor\Schedule', ['doctor_id' => Auth::user()->doctor->id]);

        $this->delete(route('schedules.destroy', $schedule->token))
            ->assertRedirect(route('schedules.index'));

        $this->assertDatabaseMissing('schedules', ['id' => $schedule->id]);
    }

    protected function submitSchedule($overrides = [])
    {
        $doctor = create('App\Models\Doctor\Doctor');

        $this->signInDoctor($doctor->user);

        $schedule = make('App\Models\Doctor\Schedule', $overrides);

        return $this->post(route('schedules.store'), $schedule->toArray());
    }
}
