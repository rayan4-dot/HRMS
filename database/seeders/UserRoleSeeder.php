<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        // Create a new user
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create or fetch the roles
        $employeeRole = Role::firstOrCreate(['name' => 'Employee']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        // Fetch or create permissions
        $createPostPermission = Permission::firstOrCreate(['name' => 'create post']);
        $editPostPermission = Permission::firstOrCreate(['name' => 'edit post']);

        // Assign permissions to roles
        $employeeRole->givePermissionTo($createPostPermission);
        $adminRole->givePermissionTo($createPostPermission, $editPostPermission);

        // Assign role to the user
        $user->assignRole($employeeRole);  // Assign the Employee role
    }
}
