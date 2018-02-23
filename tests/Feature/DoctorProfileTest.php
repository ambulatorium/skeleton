<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DoctorProfileTest extends TestCase
{
    use RefreshDatabase;

    protected $doctor;

    public function setUp()
    {
        parent::setUp();

        $this->doctor = create('App\Models\Doctor\Doctor');
    }

    /** @test */
    public function a_user_should_be_able_to_see_all_doctors()
    {
        $this->get('/doctors')
            ->assertSee($this->doctor->full_name);
    }

    /** @test */
    public function a_user_should_be_able_to_see_doctor_profile()
    {
        $this->get('/doctors/'.$this->doctor->speciality->slug.'/'.$this->doctor->slug)
            ->assertSee($this->doctor->full_name);
    }

    /** @test */
    public function a_user_should_be_able_to_filter_doctors_according_to_a_speciality()
    {
        $speciality = create('App\Models\Setting\Speciality\Speciality');
        $doctorInSpeciality = create('App\Models\Doctor\Doctor', ['speciality_id' => $speciality->id]);
        $doctorNotInSpeciality = create('App\Models\Doctor\Doctor');

        $this->get('/doctors/'.$speciality->slug)
            ->assertSee($doctorInSpeciality->full_name)
            ->assertDontSee($doctorNotInSpeciality->full_name);
    }

    /** @test */
    public function a_user_should_be_able_to_search_doctors_by_doctor_name()
    {
        $this->get('/doctors?name='.$this->doctor->full_name)
            ->assertSee($this->doctor->full_name);
    }
}
