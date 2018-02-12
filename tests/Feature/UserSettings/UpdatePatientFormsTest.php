<?php

namespace Tests\Feature\UserSettings;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdatePatientFormsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();

        $this->signIn();
    }

    /** @test */
    public function unauthorized_user_cannot_update_patient_forms()
    {
        $user = create('App\User');
        $patient_form = create('App\Models\Patient\Patient', ['user_id' => $user->id]);

        $this->get(route('patient-forms.edit', $patient_form->id))
            ->assertStatus(403);

        $this->patch(route('patient-forms.update', $patient_form->id), $this->validParams())
            ->assertStatus(403);
    }

    /** @test */
    public function a_patient_form_can_be_updated_by_its_user()
    {
        $patient_form = create('App\Models\Patient\Patient', ['user_id' => auth()->id()]);

        $this->patch(route('patient-forms.update', $patient_form->id), $this->validParams([
            'address' => 'Changed',
            'city'    => 'Changed',
            'state'   => 'Changed',
        ]));

        tap($patient_form->fresh(), function ($patient_form) {
            $this->assertEquals('Changed', $patient_form->address);
            $this->assertEquals('Changed', $patient_form->city);
            $this->assertEquals('Changed', $patient_form->state);
        });
    }

    private function validParams($overrides = [])
    {
        return array_merge([
            'form_name'       => 'my-parent',
            'full_name'       => 'John Doe',
            'dob'             => '1993-09-13',
            'gender'          => 'male',
            'address'         => 'foobar',
            'city'            => 'foobar',
            'state'           => 'foobar',
            'zip_code'        => '17510',
            'home_phone'      => '0000000000000',
            'cell_phone'      => '0000000000000',
            'marital_status'  => 'single',
        ], $overrides);
    }
}
