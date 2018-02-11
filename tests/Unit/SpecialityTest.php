<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpecialityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_specialty_consists_of_doctors()
    {
        $speciality = create('App\Models\Setting\Speciality\Speciality');
        $doctor = create('App\Models\Doctor\Doctor', ['speciality_id' => $speciality->id]);

        $this->assertTrue($speciality->doctors->contains($doctor));
    }
}
