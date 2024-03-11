<?php

namespace Tests;

use App\Models\User;
use Hamcrest\Arrays\IsArray;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    public function userWithPermissions($roleToAssign, $permissionsToAssign)
    {
        $user        = User::factory()->create();
        $role        = $this->createRole($roleToAssign);
        $permission  = $this->createPermission($permissionsToAssign);
        if(is_array($permission)) {
            echo "<pre>"; print_R($permission);
        }
        $role->syncPermissions($permission);
        $user->syncRoles($role);
        return $user;
    }

    public function userWithoutPermissions($roleToAssign)
    {
        $user       = User::factory()->create();
        $role        = $this->createRole($roleToAssign);
        $user->syncRoles($role);
        return $user;
    }

    protected function createRole($role)
    {
        return Role::create(['name' => $role]);
    }

    protected function createPermission($permissions)
    {
        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }
            return Permission::pluck('name')->toArray();
        } else {
            return Permission::create(['name' => $permissions]);
        }
    }
}
