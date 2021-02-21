<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Client']);

        Permission::create(['name' => 'admin.home'])->assignRole($role1);

        Permission::create(['name' => 'admin.roles.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.roles.create'])->assignRole($role1);
        Permission::create(['name' => 'admin.roles.edit'])->assignRole($role1);
        Permission::create(['name' => 'admin.roles.destroy'])->assignRole($role1);
        Permission::create(['name' => 'admin.roles.show'])->assignRole($role1);

        Permission::create(['name' => 'admin.users.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.create'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.edit'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.destroy'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.show'])->assignRole($role1);

        Permission::create(['name' => 'admin.computers.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.computers.create'])->assignRole($role1);
        Permission::create(['name' => 'admin.computers.edit'])->assignRole($role1);
        Permission::create(['name' => 'admin.computers.destroy'])->assignRole($role1);
        Permission::create(['name' => 'admin.computers.show'])->assignRole($role1);

        Permission::create(['name' => 'web.cyber.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'web.cyber.store'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'web.cyber.select'])->syncRoles([$role1, $role2]);

    }
}
