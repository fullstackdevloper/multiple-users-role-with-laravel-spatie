<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository
{

    public $limit = 10;

    // Constructor to initialize the Role model
    public function  __construct(Role $role)
    {
        parent::__construct($role);
    }

    // Update a role with given ID and payload
    public function updateRole($roleId, array $payload = [])
    {
        $role =  $this->updateByCriteria(['id' => $roleId], ['name' => $payload['name']]);
        // Sync permissions for the updated role
        if ($role) {
            $role->syncPermissions($payload['permissions']);
        }
        return $role;
    }

    // Create a new role with given payload
    public function createRole(array $payload = [])
    {
        $role =  $this->create(['name' => $payload['name']]);
        // Sync permissions for the created role
        if ($role) {
            $role->syncPermissions($payload['permissions']);
        }
        return $role;
    }
}
