<?php

namespace Tests\Feature\UserSettings;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateDoctorSchedulesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();

        $doctor = create('App\Models\Doctor\Doctor');

        $this->signInDoctor($doctor->user);
    }

    /** @test */
    public function unauthorized_users_cannot_access_schedules()
    {
        $schedule = create('App\Models\Doctor\Schedule');

        $this->get(route('schedules.show', $schedule->token))->assertStatus(403);
    }

    /** @test */
    public function unauthorized_users_cannot_update_schedules()
    {
        $schedule = create('App\Models\Doctor\Schedule');

        $this->patch(route('schedules.update', $schedule->token), [
            'day'                     => 'Monday',
            'start_time'              => '09:00:00',
            'end_time'                => '17:00:00',
            'estimated_service_time'  => '35',
            'estimated_price_service' => '500',
            'is_available'            => true,
        ])->assertStatus(403);
    }

    /** @test */
    public function a_schedule_requires_fields()
    {
        $schedule = create('App\Models\Doctor\Schedule', ['doctor_id' => Auth::user()->doctor->id]);

        $this->patch(route('schedules.update', $schedule->token), [
            'day' => 'Changed',
        ])->assertSessionHasErrors('start_time');

        $this->patch(route('schedules.update', $schedule->token), [
            'start_time' => 'Changed',
        ])->assertSessionHasErrors('day');

        $this->patch(route('schedules.update', $schedule->token), [
            'end_time' => 'Changed',
        ])->assertSessionHasErrors('start_time');

        $this->patch(route('schedules.update', $schedule->token), [
            'estimated_service_time' => 'Changed',
        ])->assertSessionHasErrors('estimated_price_service');

        $this->patch(route('schedules.update', $schedule->token), [
            'estimated_price_service' => 'Changed',
        ])->assertSessionHasErrors('estimated_service_time');
    }

    /** @test */
    public function a_schedule_can_be_updated_by_its_doctor()
    {
        $schedule = create('App\Models\Doctor\Schedule', ['doctor_id' => Auth::user()->doctor->id]);

        $this->patch(route('schedules.update', $schedule->token), [
            'day'                     => 'Changed',
            'start_time'              => '10:00:00',
            'end_time'                => '15:00:00',
            'estimated_service_time'  => '35',
            'estimated_price_service' => '500',
            'is_available'            => true,
        ]);

        tap($schedule->fresh(), function ($schedule) {
            $this->assertEquals('Changed', $schedule->day);
            $this->assertEquals('10:00:00', $schedule->start_time);
            $this->assertEquals('15:00:00', $schedule->end_time);
        });
    }
}