<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SearchTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->speciality = create('App\Models\Setting\Speciality\Speciality');
        $this->group = create('App\Models\Setting\Group\Group');
        $this->doctor = create('App\Models\Doctor\Doctor');
    }
    
    /** @test */
    public function a_user_can_view_form_search_doctor_schedule()
    {
        $this->get('/')
            ->assertSee($this->speciality->name)
            ->assertSee($this->group->name);
    }

    /** @test */
    public function a_user_can_search_a_doctor()
    {
        $this->get('/search')
            ->assertSee($this->doctor->full_name)
            ->assertSee($this->doctor->group->name);
    }
}
