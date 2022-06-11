<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $seller = Role::create(['name' => 'Vendedor']);
        $auditor = Role::create(['name' => 'Auditor']);

        Permission::create(['name' => 'user read']);
        Permission::create(['name' => 'user detail']);
        Permission::create(['name' => 'user update']);
        Permission::create(['name' => 'user create']);
        Permission::create(['name' => 'user delete']);
        Permission::create(['name' => 'product read']);
        Permission::create(['name' => 'product detail']);
        Permission::create(['name' => 'product update']);
        Permission::create(['name' => 'product create']);
        Permission::create(['name' => 'product delete']);
        Permission::create(['name' => 'report create']);
        Permission::create(['name' => 'report view']);

        $seller->syncPermissions(Permission::all());
        $auditor->syncPermissions([
            'report create',
            'report create',
            'report view',
        ]);
    }
}
