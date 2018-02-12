<?php

namespace Tests\Feature\UserSettings;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePatientFormsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();
    }

    /** @test */
    public function guests_may_not_create_patient_forms()
    {
        $this->get(route('patient-forms.create'))
            ->assertRedirect(route('login'));
            
        $this->post(route('patient-forms.store'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function authorized_user_can_create_patient_forms()
    {
        $response = $this->submitForm([
            'form_name'      => 'my parent',
            'full_name'      => 'John Doe',
            'gender'         => 'Male',
        ]);

        $this->get($response->headers->get('Location'))
            ->assertSee('my parent')
            ->assertSee('John Doe')
            ->assertSee('Male');
    }

    /** @test */
    public function a_patient_form_required_form_name()
    {
        $this->submitForm(['form_name' => null])
            ->assertSessionHasErrors('form_name');
    }

    /** @test */
    public function a_patient_form_required_full_name()
    {
        $this->submitForm(['full_name' => null])
            ->assertSessionHasErrors('full_name');
    }

    /** @test */
    public function a_patient_form_required_date_of_birth()
    {
        $this->submitForm(['dob' => null])
            ->assertSessionHasErrors('dob');
    }

    /** @test */
    public function a_patient_form_required_gender()
    {
        $this->submitForm(['gender' => null])
            ->assertSessionHasErrors('gender');
    }

    /** @test */
    public function a_patient_form_required_address()
    {
        $this->submitForm(['address' => null])
            ->assertSessionHasErrors('address');
    }

    /** @test */
    public function a_patient_form_required_city()
    {
        $this->submitForm(['city' => null])
            ->assertSessionHasErrors('city');
    }

    /** @test */
    public function a_patient_form_required_state()
    {
        $this->submitForm(['state' => null])
            ->assertSessionHasErrors('state');
    }

    /** @test */
    public function a_patient_form_required_zip_code()
    {
        $this->submitForm(['zip_code' => null])
            ->assertSessionHasErrors('zip_code');
    }

    /** @test */
    public function a_patient_form_required_cell_phone()
    {
        $this->submitForm(['cell_phone' => null])
            ->assertSessionHasErrors('cell_phone');
    }

    /** @test */
    public function a_patient_form_required_marital_status()
    {
        $this->submitForm(['marital_status' => null])
            ->assertSessionHasErrors('marital_status');
    }

    protected function submitForm($overrides = [])
    {
        $this->signIn();

        $patient_form = make('App\Models\Patient\Patient', $overrides);

        return $this->post(route('patient-forms.store'), $patient_form->toArray());
    }
}
