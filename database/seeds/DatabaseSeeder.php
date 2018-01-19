<?php

use App\User;
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
        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {
            $this->command->call('migrate:refresh');
            $this->command->warn('Data cleared, starting from blank database.');
        }

        // Confirm roles and permisson default needed
        if ($this->command->confirm('Create default roles, permission and user owner?', true)) {
            app()['cache']->forget('spatie.permission.cache'); // Reset cached roles and permissions

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
            }

            $this->command->info('Default Roles added.');
            $user = factory(User::class)->create();
            $user->assignRole('owner');
            $this->command->info('Default Owner added.');
            $this->command->info('Here is your owner details to login:');
            $this->command->warn($user->email);
            $this->command->warn('Password is "secret"');
        }
    }
}
