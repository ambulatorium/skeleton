<?php

namespace Tests\Feature\UserSettings;

use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateAccountTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();

        $this->signIn();
    }

    /** @test */
    public function the_authorized_user_can_update_their_account()
    {
        $user = create('App\User');

        $this->actingAs($user);

        $this->patch('/user/settings/account/'.$user->id, [
            'name'                  => 'John Doe',
            'email'                 => 'johndoe@example.com',
            'password'              => 'nosecret',
            'password_confirmation' => 'nosecret',
        ]);

        tap($user->fresh(), function ($user) {
            $this->assertEquals('John Doe', $user->name);
            $this->assertEquals('johndoe@example.com', $user->email);
            $this->assertTrue(Hash::check('nosecret', $user->password));
        });
    }

    /** @test */
    public function name_is_required()
    {
        $this->from('/user/settings/account');

        $response = $this->patch('/user/settings/account/'.auth()->id(), [
            'name' => '',
        ]);

        $response->assertRedirect('/user/settings/account');
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_cannot_exceed_255_chars()
    {
        $this->from('/user/settings/account');

        $response = $this->patch('/user/settings/account/'.auth()->id(), [
            'name' => str_repeat('a', 256),
        ]);

        $response->assertRedirect('/user/settings/account');
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function password_must_be_confirmed()
    {
        $this->from('/user/settings/account');

        $response = $this->patch('/user/settings/account/'.auth()->id(), $this->validParams([
            'password' => 'foo',
            'password_confirmation' => 'bar',
        ]));

        $response->assertRedirect('/user/settings/account');
        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function password_must_be_6_chars()
    {
        $this->from('/user/settings/account');

        $response = $this->patch('/user/settings/account/'.auth()->id(), $this->validParams([
            'password' => 'foo',
            'password_confirmation' => 'foo',
        ]));

        $response->assertRedirect('/user/settings/account');
        $response->assertSessionHasErrors('password');
    }

    private function validParams($overrides = [])
    {
        return array_merge([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ], $overrides);
    }
}
