<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_group_consists_of_doctors()
    {
        $group = create('App\Models\Setting\Group\Group');
        $doctor = create('App\Models\Doctor\Doctor', ['group_id' => $group->id]);

        $this->assertTrue($group->doctors->contains($doctor));
    }

    /** @test */
    public function a_group_consists_of_staffs()
    {
        $group = create('App\Models\Setting\Group\Group');
        $staff = create('App\Models\Setting\Staff\Staff', ['group_id' => $group->id]);

        $this->assertTrue($group->staffs->contains($staff));
    }

    /** @test */
    public function a_group_consists_of_appointments()
    {
        $group = create('App\Models\Setting\Group\Group');
        $appointment = create('App\Models\Appointment\Appointment', ['group_id' => $group->id]);

        $this->assertTrue($group->appointments->contains($appointment));
    }
}
