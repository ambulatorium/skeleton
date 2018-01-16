<?php

use App\User;
use App\Models\Patient\Patient;
use Illuminate\Database\Seeder;
use App\Models\Setting\Staff\Role;
use App\Models\Setting\Staff\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // Call the php artisan migrate:refresh
        $this->command->call('migrate:refresh');
        $this->command->warn('Data cleared, starting from blank database.');

        $permissions = Permission::defaultPermissions();

        // Seed the default permissions
        foreach ($permissions as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }
        $this->command->info('Default Permissions added.');

        $roles = Role::defaultRoles();

        // Seed the default roles
        foreach ($roles as $role) {
            $role = Role::firstOrCreate(['name' => $role]);

            if ($role->name == 'owner') {
                // assign all permissions
                $role->syncPermissions(Permission::all());
                $this->command->info('Owner granted all the permissions');
            }

            if ($role->name == 'doctor') {
                $role->givePermissionTo([
                    'view-schedules', 'add-schedules', 'edit-schedules', 'delete-schedules',
                ]);
            }
        }

        $this->command->info('Default Roles added.');
        $this->command->warn('Create default user role owner"');
        $user = factory(User::class)->create();
        $user->assignRole('owner');
        $this->command->info('Default Owner added.');
        $this->command->info('Here is your owner details to login:');
        $this->command->warn($user->email);
        $this->command->warn('Password is "secret"');
    }
}
