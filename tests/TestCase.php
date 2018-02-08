<?php

namespace Tests;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signIn($user = null)
    {
        $user = $user ?: create('App\User');

        $this->actingAs($user);

        return $this;
    }

    protected function signInOwner($owner = null)
    {
        Role::create(['name' => 'owner']);

        $owner = $owner ?: create('App\User');
        $owner->assignRole('owner');

        $this->actingAs($owner);

        return $this;
    }

    protected function signInAdministrator($administrator = null)
    {
        Role::create(['name' => 'administrator']);

        $administrator = $administrator ?: create('App\User');
        $administrator->assignRole('administrator');

        $this->actingAs($administrator);

        return $this;
    }
}
