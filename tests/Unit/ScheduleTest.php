<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScheduleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_schedule_belongs_to_a_doctor()
    {
        $schedule = create('App\Models\Doctor\Schedule');

        $this->assertInstanceOf('App\Models\Doctor\Doctor', $schedule->doctor);
    }
}
