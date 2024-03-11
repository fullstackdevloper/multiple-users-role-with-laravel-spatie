<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'     => 'super admin',
                'email'    => 'superadmin@gmail.com',
                'password' => Hash::make(123456789),
                'role'     => Roles::SUPERADMIN
            ],
            [
                'name'     => 'manager',
                'email'    => 'manager@gmail.com',
                'password' => Hash::make(123456789),
                'role'     => Roles::MANAGER
            ],
            [
                'name'     => 'subscriber',
                'email'    => 'subscriber@gmail.com',
                'password' => Hash::make(123456789),
                'role'     => Roles::SUBSCRIBER
            ],
        ];

        foreach ($users as $user) {
            $role = $user['role'];
            unset($user['role']);

            $newUser = User::updateOrCreate(['email' => $user['email']], $user);
            $role    = Role::findByName($role, 'web');

            if ($role) {
                $newUser->assignRole($role);
            } else {
                echo "Error: Can not find role {$user['role']} for user {$user['name']}\n";
            }
        }
    }
}
