<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {

        $employee = Role::findByName('Employee');
        $manager = Role::findByName('Manager');
        $rh = Role::findByName('RH');
        $admin = Role::findByName('Admin');
    

        $createPost = Permission::findByName('create post');
        $editPost = Permission::findByName('edit post');
        $deletePost = Permission::findByName('delete post');
        $viewPost = Permission::findByName('view post');
        $assignRole = Permission::findByName('assign role');
        $manageUser = Permission::findByName('manage user');
    

        $employee->givePermissionTo($viewPost); 
        $manager->givePermissionTo([$createPost, $editPost, $viewPost]); 
        $rh->givePermissionTo([$viewPost, $manageUser]); 
        $admin->givePermissionTo(Permission::all());
    }
    
}
