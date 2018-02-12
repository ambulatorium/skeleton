<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_patient_forms()
    {
        $patient_form = create('App\Models\Patient\Patient');

        $this->assertInstanceOf('App\User', $patient_form->user);
    }
}
