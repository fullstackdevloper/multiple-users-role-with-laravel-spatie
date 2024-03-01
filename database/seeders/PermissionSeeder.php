<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionsData = [
            'users.list',
            'users.create',
            'users.edit',
            'roles.list',
            'roles.create'
        ];

        foreach ($permissionsData as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }
    }
}
