<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;


class RolesSeeder extends Seeder
{
    public function run()
    {

        $employeeRole = Role::create(['name' => 'Employee']);
        

        $employeeRole->givePermissionTo([
            'view personal info', 
            'view job info', 
            'view company info',
            'view contract info'
        ]);

        // create other roles and assign permissions
        $managerRole = Role::create(['name' => 'Manager']);
    }
}