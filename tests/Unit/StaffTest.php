<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StaffTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_staff_has_a_group()
    {
        $staff = create('App\Models\Setting\Staff\Staff');

        $this->assertInstanceOf('App\Models\Setting\Group\Group', $staff->group);
    }
}
