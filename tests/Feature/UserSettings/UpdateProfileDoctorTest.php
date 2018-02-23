<?php

namespace Tests\Feature\UserSettings;

use Tests\TestCase;
use App\Models\Doctor\Doctor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateProfileDoctorTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();
    }

    /** @test */
    public function unauthorized_users_may_not_update_profile_doctors()
    {
        $this->signIn();

        $doctor = create(Doctor::class, ['user_id' => create('App\User')->id]);

        $this->patch(route('profileDoctor.update', $doctor->slug), $this->validParams())
            ->assertStatus(403);
    }

    /** @test */
    public function an_authorized_user_can_update_their_profile_doctor()
    {
        $this->signInDoctor();

        $doctor = create(Doctor::class, ['user_id' => auth()->id()]);

        $this->patch(route('profileDoctor.update', $doctor->slug), $this->validParams([
            'full_name' => 'Changed',
            'bio'       => 'Changed',
        ]));

        tap($doctor->fresh(), function ($doctor) {
            $this->assertEquals('Changed', $doctor->full_name);
            $this->assertEquals('Changed', $doctor->bio);
        });
    }

    private function validParams($overrides = [])
    {
        return array_merge([
            'speciality_id'       => '1',
            'full_name'           => 'John Doe',
            'years_of_experience' => '5',
            'qualification'       => 'MBBS',
            'bio'                 => 'foo',
            'is_active'           => true,
        ], $overrides);
    }
}
