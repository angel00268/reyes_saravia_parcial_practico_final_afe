<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::create(['name' => 'Administrador']);
        $user = Role::create(['name' => 'Usuario']);

        Permission::create(['name' => 'user read']);
        Permission::create(['name' => 'user detail']);
        Permission::create(['name' => 'user update']);
        Permission::create(['name' => 'user create']);
        Permission::create(['name' => 'user delete']);
        Permission::create(['name' => 'bank read']);
        Permission::create(['name' => 'bank detail']);
        Permission::create(['name' => 'bank update']);
        Permission::create(['name' => 'bank create']);
        Permission::create(['name' => 'bank delete']);

        $admin->syncPermissions(Permission::all());
    }
}
