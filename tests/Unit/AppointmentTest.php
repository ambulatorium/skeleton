<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_user()
    {
        $appointment = create('App\Models\Appointment\Appointment');

        $this->assertInstanceOf('App\User', $appointment->user);
    }

    /** @test */
    public function it_belongs_to_a_doctor()
    {
        $appointment = create('App\Models\Appointment\Appointment');

        $this->assertInstanceOf('App\Models\Doctor\Doctor', $appointment->doctor);
    }

    /** @test */
    public function it_belongs_to_a_schedule()
    {
        $appointment = create('App\Models\Appointment\Appointment');

        $this->assertInstanceOf('App\Models\Doctor\Schedule', $appointment->schedule);
    }

    /** @test */
    public function it_belongs_to_a_patient()
    {
        $appointment = create('App\Models\Appointment\Appointment');

        $this->assertInstanceOf('App\Models\Patient\Patient', $appointment->patient);
    }
}
