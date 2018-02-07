<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RolePermissionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $permission = Permission::create(['name' => 'edit_groups']);
        $role = Role::create(['name' => 'owner']);
        $role->givePermissionTo($permission->name);

        $this->app->make(PermissionRegistrar::class)->registerPermissions();
    }

    /** @test */
    public function it_can_assign_a_role_and_confirm_the_role_is_assigned()
    {
        $user = create('App\User');
        $user->assignRole('owner');

        $owner = User::find($user->id);

        $this->assertTrue($owner->hasRole('owner'));
        $this->assertTrue($owner->hasPermissionTo('edit_groups'));
        $this->assertTrue($owner->can('edit_groups'));

    }
}
