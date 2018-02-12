<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DoctorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_doctor_belongs_to_a_user()
    {
        $doctor = create('App\Models\Doctor\Doctor');

        $this->assertInstanceOf('App\User', $doctor->user);
    }

    /** @test */
    public function a_doctor_belongs_to_a_group()
    {
        $doctor = create('App\Models\Doctor\Doctor');

        $this->assertInstanceOf('App\Models\Setting\Group\Group', $doctor->group);        
    }

    /** @test */
    public function a_doctor_belongs_to_a_speciality()
    {
        $doctor = create('App\Models\Doctor\Doctor');

        $this->assertInstanceOf('App\Models\Setting\Speciality\Speciality', $doctor->speciality);   
    }
}
