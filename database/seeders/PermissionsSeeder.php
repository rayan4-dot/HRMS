<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run()
    {

        Permission::create(['name' => 'view personal info']);
        Permission::create(['name' => 'view job info']);
        Permission::create(['name' => 'view company info']);
        Permission::create(['name' => 'view contract info']);
        Permission::create(['name' => 'view all users']);
        Permission::create(['name' => 'edit user']);
    }


}
