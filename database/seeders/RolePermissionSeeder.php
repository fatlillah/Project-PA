<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'delete-user']);
        Permission::create(['name' => 'read-user']);

        Permission::create(['name' => 'create-data']);
        Permission::create(['name' => 'edit-data']);
        Permission::create(['name' => 'delete-data']);
        Permission::create(['name' => 'read-data']);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'kasir']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('create-user');
        $roleAdmin->givePermissionTo('edit-user');
        $roleAdmin->givePermissionTo('delete-user');
        $roleAdmin->givePermissionTo('read-user');
        $roleAdmin->givePermissionTo('create-data');
        $roleAdmin->givePermissionTo('edit-data');
        $roleAdmin->givePermissionTo('delete-data');
        $roleAdmin->givePermissionTo('read-data');

        $roleKasir = Role::findByName('kasir');
        $roleKasir->givePermissionTo('create-data');
        $roleKasir->givePermissionTo('read-data');
    }
}
