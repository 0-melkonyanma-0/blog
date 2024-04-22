<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect(config('roles.roles'))->each(function (array $permissions, string $title) {
            $role = Role::updateOrCreate([
                'name' => $title
            ]);
            collect($permissions)->each(function (string $permission) use ($role) {
                $permission = Permission::updateOrCreate([
                    'name' => $permission
                ]);

                $role->givePermissionTo($permission);
            });
        });
    }
}
