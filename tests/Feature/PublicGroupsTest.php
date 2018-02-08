<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublicGroupsTest extends TestCase
{
    use RefreshDatabase;

    protected $group;

    public function setUp()
    {
        parent::setUp();

        $this->group = create('App\Models\Setting\Group\Group');
    }
    
    /** @test */
    public function guests_can_view_public_group()
    {
        $this->get(route('group', $this->group->slug))
            ->assertSee($this->group->name)
            ->assertSee($this->group->city)
            ->assertSee($this->group->address);
    }

    /** @test */
    public function guests_can_see_doctors_according_to_public_group()
    {
        $doctorInGroup = create('App\Models\Doctor\Doctor', ['group_id' => $this->group->id]);
        $doctorNotInGroup = create('App\Models\Doctor\Doctor');

        $this->get(route('group', $this->group->slug))
            ->assertSee($doctorInGroup->full_name)
            ->assertSee($doctorInGroup->speciality->name)
            ->assertDontSee($doctorNotInGroup->full_name);
    }
}
