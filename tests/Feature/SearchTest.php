<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_user_can_search_a_doctor()
    {
        $doctor = create('App\Models\Doctor\Doctor');

        $this->get('/search')
            ->assertSee($doctor->full_name)
            ->assertSee($doctor->group->name);
    }
}
