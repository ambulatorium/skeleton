<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_patient_form_belongs_to_a_user()
    {
        $patient_form = create('App\Models\Patient\Patient');

        $this->assertInstanceOf('App\User', $patient_form->user);
    }
}
