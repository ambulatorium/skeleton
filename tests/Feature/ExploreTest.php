<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExploreTest extends TestCase
{
    use RefreshDatabase;

    protected $group;

    public function setUp()
    {
        parent::setUp();

        $this->group = create('App\Models\Setting\Group\Group');
    }

    /** @test */
    public function a_user_can_view_all_groups()
    {
        $this->get('/explore')
            ->assertSee($this->group->name);
    }

    /** @test */
    public function a_user_can_view_a_single_group()
    {
        $this->get('/'.$this->group->slug)
            ->assertSee($this->group->name);
    }

    /** @test */
    public function a_user_can_see_doctors_according_to_single_group()
    {
        $doctorInGroup = create('App\Models\Doctor\Doctor', ['group_id' => $this->group->id]);
        $doctorNotInGroup = create('App\Models\Doctor\Doctor');

        $this->get(route('group', $this->group->slug))
            ->assertSee($doctorInGroup->full_name)
            ->assertSee($doctorInGroup->speciality->name)
            ->assertDontSee($doctorNotInGroup->full_name);
    }

    /** @test */
    public function a_user_can_view_all_specialities()
    {
        $speciality = create('App\Models\Setting\Speciality\Speciality');

        $this->get('/explore')
            ->assertSee($speciality->name);
    }

    /** @test */
    public function a_user_can_view_all_doctors()
    {
        $doctor = create('App\Models\Doctor\Doctor');

        $this->get('/explore')
            ->assertSee($doctor->full_name);
    }
}
