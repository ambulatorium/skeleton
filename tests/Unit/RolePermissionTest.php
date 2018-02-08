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

    /** @test */
    public function it_can_assign_a_role_and_confirm_the_role_is_assigned()
    {
        $user = create('App\User');
        $user->assignRole('owner');

        $owner = User::find($user->id);

        $this->assertTrue($owner->hasRole('owner'));
        $this->assertTrue($owner->hasPermissionTo('edit-groups'));
        $this->assertTrue($owner->can('edit-groups'));

    }
}
