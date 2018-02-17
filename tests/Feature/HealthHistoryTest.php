<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HealthHistoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthorized_users_should_be_login_before_access_to_health_history()
    {
        $this->withExceptionHandling()
            ->get('/user/health-history')
            ->assertRedirect('/login');
    }

    /** @test */
    public function authorized_users_should_be_able_to_see_all_its_health_history()
    {
        $this->signIn();

        $patientForm = create('App\Models\Patient\Patient', ['user_id' => auth()->id()]);
        $healthHistory = create('App\Models\Patient\HealthHistory', ['patient_id' => $patientForm->id]);

        $this->get('/user/health-history')
            ->assertSee($patientForm->full_name)
            ->assertSee($healthHistory->appointment_patient_condition);
    }

    /** @test */
    public function authorized_users_should_be_not_able_to_see_details_all_health_history()
    {
        $this->signIn();

        $healthHistory = create('App\Models\Patient\HealthHistory');

        $this->get('/user/health-history/'.$healthHistory->id)->assertStatus(403);
    }

    /** @test */
    public function authorized_users_should_be_able_to_see_details_its_health_history()
    {
        $this->signIn();

        $patientForm = create('App\Models\Patient\Patient', ['user_id' => auth()->id()]);
        $healthHistory = create('App\Models\Patient\HealthHistory', ['patient_id' => $patientForm->id]);

        $this->get('/user/health-history/'.$healthHistory->id)
            ->assertSee($patientForm->full_name)
            ->assertSee($healthHistory->group->name)
            ->assertSee($healthHistory->doctor->full_name)
            ->assertSee($healthHistory->doctor_diagnosis)
            ->assertSee($healthHistory->doctor_action);
    }
}
