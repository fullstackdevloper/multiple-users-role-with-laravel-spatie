<?php

namespace Database\Seeders;

use App\Enums\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [Roles::SUPERADMIN,Roles::MANAGER, Roles::SUBSCRIBER];

        foreach($roles as $role) {
            Role::findOrCreate($role);
        }
    }
}
