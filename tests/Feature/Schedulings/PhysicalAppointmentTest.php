<?php

namespace Tests\Feature\Schedulings;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PhysicalAppointmentTest extends TestCase
{
    use RefreshDatabase;

    protected $speciality;
    protected $doctor;

    public function setUp()
    {
        parent::setUp();

        $this->speciality = create('App\Models\Setting\Speciality\Speciality');
        $this->doctor = create('App\Models\Doctor\Doctor', ['speciality_id' => $this->speciality->id]);
    }

    /** @test */
    public function guests_should_seek_a_doctors_schedule_before_scheduling_a_physical_appointment()
    {
        $requestDate = today()->addDays(1);

        $doctorSchedule = create('App\Models\Doctor\Schedule', [
            'doctor_id' => $this->doctor->id,
            'day'       => $requestDate->format('l'),
        ]);

        $this->get('/scheduling/physical-appointment?location='.$this->doctor->group->name.'&speciality='.$this->speciality->name.'&date='.$requestDate)
            ->assertSee($this->doctor->full_name)
            ->assertSee($this->doctor->group->name)
            ->assertSee($this->doctor->speciality->name)
            ->assertSee(Carbon::parse($doctorSchedule->start_time)->format('g:ia'))
            ->assertSee(Carbon::parse($doctorSchedule->end_time)->format('g:ia'));
    }

    /** @test */
    public function a_group_name_should_required()
    {
        $requestDate = today()->addDays(1);

        $this->get('/scheduling/physical-appointment?speciality='.$this->speciality->name.'&date='.$requestDate)
            ->assertSessionHasErrors('location');
    }

    /** @test */
    public function a_speciality_name_should_required()
    {
        $requestDate = today()->addDays(1);

        $this->get('/scheduling/physical-appointment?location='.$this->doctor->group->name.'&date='.$requestDate)
            ->assertSessionHasErrors('speciality');
    }

    /** @test */
    public function a_date_should_required()
    {
        $this->get('/scheduling/physical-appointment?location='.$this->doctor->group->name.'&speciality='.$this->speciality->name)
            ->assertSessionHasErrors('date');
    }

    /** @test */
    public function a_date_should_required_with_minimum_date_is_tomorrow()
    {
        $minDate = today();

        $this->get('/scheduling/physical-appointment?location='.$this->doctor->group->name.'&speciality='.$this->speciality->name.'&date='.$minDate)
            ->assertStatus(404);
    }

    /** @test */
    public function a_date_should_required_with_maximum_date_is_a_week_from_tomorrow()
    {
        $tomorrow = today()->addDays(1);

        $this->get('/scheduling/physical-appointment?location='.$this->doctor->group->name.'&speciality='.$this->speciality->name.'&date='.$tomorrow->addDays(7))
            ->assertStatus(404);
    }
}
