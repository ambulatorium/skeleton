<?php

namespace Tests\Feature\UserSettings;

use Tests\TestCase;
use App\Models\Patient\Patient;
use App\Models\Appointment\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Patient\HealthHistory;

class DeletePatientFormsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();

        $this->signIn();
    }

    /** @test */
    public function unauthorized_users_should_be_not_able_to_delete_patient_form()
    {
        $patient_form = create(Patient::class);

        $this->delete(route('patient-forms.destroy', $patient_form->id))->assertStatus(403);
    }

    /** @test */
    public function authorized_users_should_be_not_able_to_delete_patient_forms_that_have_appointment()
    {
        $patient_form = create(Patient::class, ['user_id' => auth()->id()]);
        $appointment = create(Appointment::class, ['patient_id' => $patient_form->id]);

        $this->delete(route('patient-forms.destroy', $patient_form->id));

        $this->assertDatabaseHas('patients', ['user_id' => auth()->id()]);
        $this->assertDatabaseHas('patients', ['id' => $patient_form->id]);
        $this->assertDatabaseHas('appointments', ['patient_id' => $patient_form->id]);
    }

    /** @test */
    public function authorized_users_should_be_not_able_to_delete_patient_forms_that_have_health_history()
    {
        $patient_form = create(Patient::class, ['user_id' => auth()->id()]);
        $healthHistory = create(HealthHistory::class, ['patient_id' => $patient_form->id]);

        $this->delete(route('patient-forms.destroy', $patient_form->id));
        
        $this->assertDatabaseHas('patients', ['user_id' => auth()->id()]);
        $this->assertDatabaseHas('patients', ['id' => $patient_form->id]);
        $this->assertDatabaseHas('health_histories', ['patient_id' => $patient_form->id]);
    }

    /** @test */
    public function authorized_users_should_be_able_to_delete_its_patient_forms()
    {
        $patient_form = create(Patient::class, ['user_id' => auth()->id()]);

        $this->delete(route('patient-forms.destroy', $patient_form->id));

        $this->assertDatabaseMissing('patients', ['id' => $patient_form->id]);
    }
}
