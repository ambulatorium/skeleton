<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_user_can_view_form_search_doctor_schedule()
    {
        $speciality = create('App\Models\Setting\Speciality\Speciality');
        $group = create('App\Models\Setting\Group\Group');

        $this->get('/')
            ->assertSee($speciality->name)
            ->assertSee($group->name);
    }

    /** @test */
    public function a_user_can_search_a_doctor()
    {
        $doctor = create('App\Models\Doctor\Doctor');

        $this->get('/search')
            ->assertSee($doctor->full_name)
            ->assertSee($doctor->group->name);
    }
}
