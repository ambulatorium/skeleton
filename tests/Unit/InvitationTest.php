<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvitationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_invites_staff_belongs_to_a_group()
    {
        $group = create('App\Models\Setting\Group\Group');

        $invitation = create('App\Models\Invitation', [
            'email' => 'john@example.com',
            'role' => 'admin-group',
            'group_id' => $group->id,
        ]);
        
        $this->assertInstanceOf('App\Models\Setting\Group\Group', $invitation->group);
    }
}
