<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'Admin']);
        Permission::create(['name' => 'Parent']);
        Permission::create(['name' => 'Teacher']);
        Permission::create(['name' => 'Staff']);
        Permission::create(['name' => 'Student']);

        $role['Admin'] = Role::create(['name' => 'Admin'])->givePermissionTo(Permission::all());
        $role['Parent'] = Role::create(['name' => 'Parent'])->givePermissionTo(['Parent']);
        $role['Teacher'] = Role::create(['name' => 'Teacher'])->givePermissionTo(['Teacher']);
        $role['Staff'] = Role::create(['name' => 'Staff'])->givePermissionTo(['Staff']);
        $role['Student'] = Role::create(['name' => 'Student'])->givePermissionTo(['Student']);
    }
}
