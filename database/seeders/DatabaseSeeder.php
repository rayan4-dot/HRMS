<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        $this->call([
            RolesSeeder::class,
            PermissionsSeeder::class, 
        ]);
    

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'kudo@admin.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('Admin');  // Assign 'Admin' role after it's created
    
        // Other users
        $rh = User::create([
            'name' => 'HR Manager',
            'email' => 'rayan@rh.com',
            'password' => bcrypt('password'),
        ]);
        $rh->assignRole('RH');
    
        $manager = User::create([
            'name' => 'Manager User',
            'email' => 'kudo@manager.com',
            'password' => bcrypt('password'),
        ]);
        $manager->assignRole('Manager');
    
        $employee = User::create([
            'name' => 'Employee User',
            'email' => 'kudo@employe.com',
            'password' => bcrypt('password'),
        ]);
        $employee->assignRole('Employee');
    }
}
