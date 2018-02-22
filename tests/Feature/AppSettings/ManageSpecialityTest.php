<?php

namespace Tests\Feature\AppSettings;

use Tests\TestCase;
use App\Models\Setting\Speciality\Speciality;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageSpecialityTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();
    }

    /** @test */
    public function guests_cannot_access_specialities_on_app_settings_section()
    {
        $this->get(route('specialities.index'))
            ->assertRedirect('/login');

        $this->get(route('specialities.create'))
            ->assertRedirect('/login');
    }

    /** @test */
    public function unauthorized_users_cannot_access_specialities_on_app_settings_section()
    {
        $this->signIn()
            ->get(route('specialities.index'))
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->signIn()
            ->get(route('specialities.create'))
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->signIn()
            ->post(route('specialities.store'))
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function authorized_users_can_access_specialities_on_app_settings_section()
    {
        $this->signInOwner()
            ->get(route('specialities.index'))
            ->assertStatus(Response::HTTP_OK);

        $this->signInAdministrator()
            ->get(route('specialities.create'))
            ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function authorized_users_can_create_a_speciality()
    {
        $response = $this->createSpeciality([
            'name'        => 'Pulmonology',
            'description' => 'example description.',
        ]);

        $this->get($response->headers->get('Location'))
            ->assertSee('Pulmonology')
            ->assertSee('example description.');
    }

    /** @test */
    public function a_speciality_requires_name()
    {
        $this->createSpeciality(['name' => null])
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_speciality_requires_description()
    {
        $this->createSpeciality(['description' => null])
            ->assertSessionHasErrors('description');
    }

    /** @test */
    public function unauthorized_users_cannot_edit_an_existing_speciality()
    {
        $this->patch(
            route('specialities.update', ['speciality' => create(Speciality::class)])
        )->assertRedirect('/login');

        $this->signIn();
        $this->patch(
            route('specialities.update', ['speciality' => create(Speciality::class)])
        )->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_edit_an_existing_speciality()
    {
        $this->signInOwner();
        $this->signInAdministrator();

        $this->patch(
            route('specialities.update', ['speciality' => create(Speciality::class)->slug]),
            $updatedSpeciality = [
                'name'        => 'speciality name',
                'description' => 'speciality description',
            ]
        );

        $this->get(route('specialities.index'))
            ->assertSee($updatedSpeciality['name'])
            ->assertSee($updatedSpeciality['description']);
    }

    /** @test */
    public function unauthorized_users_cannot_delete_a_speciality()
    {
        $this->delete(
            route('specialities.destroy', ['speciality' => create(Speciality::class)])
        )->assertRedirect('/login');

        $this->signIn();
        $this->delete(
            route('specialities.destroy', ['speciality' => create(Speciality::class)])
        )->assertStatus(403);
    }

    /** @test */
    public function authorized_users_cannot_delete_speciality_that_have_doctors()
    {
        $this->signInOwner();
        $this->signInAdministrator();

        $speciality = create(Speciality::class);
        $doctor = create('App\Models\Doctor\Doctor', ['speciality_id' => $speciality->id]);

        $this->delete(route('specialities.destroy', $speciality->id));

        $this->assertDatabaseHas('specialities', ['id' => $speciality->id]);
        $this->assertDatabaseHas('doctors', ['speciality_id' => $speciality->id]);
    }

    /** @test */
    public function authorized_users_can_delete_speciality()
    {
        $this->signInOwner();
        $this->signInAdministrator();

        $speciality = create(Speciality::class);

        $this->delete(route('specialities.destroy', $speciality->slug));

        $this->assertDatabaseMissing('specialities', ['id' => $speciality->id]);
    }

    protected function createSpeciality($overrides = [])
    {
        $this->signInOwner();
        $this->signInAdministrator();

        $speciality = make(Speciality::class, $overrides);

        return $this->post(route('specialities.store'), $speciality->toArray());
    }
}
