<?php

namespace Database\Seeders;

use App\Enums\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionsData = [
            Roles::SUPERADMIN => [
                'users.list',
                'users.create',
                'users.edit',
                'roles.list',
                'roles.create'
            ],
            Roles::MANAGER => [
                'users.list',
                'roles.list',
            ],
            Roles::SUBSCRIBER => [
                'users.list',
            ],
            Roles::EDITOR => []
        ];

        $allPermissions = array_unique(array_merge(...array_values($permissionsData)));


        foreach ($allPermissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }

        foreach ($permissionsData as $roleName  => $permissions) {
            $role  = Role::firstOrCreate(['name' => $roleName]);
            if (!empty($permissions)) {
                $permissionModels = Permission::whereIn('name', $permissions)->get();
                $role->syncPermissions($permissionModels->pluck('name'));
            }
        }
    }
}
