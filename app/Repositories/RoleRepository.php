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

    // Get all roles paginated with conditions and relations
    public function getAllPaginateRoles(array $condition = [], array $withRelation)
    {
        return $this->paginate($this->limit, $condition, $withRelation);
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

    // Remove a role and detach its permissions
    public function removeRole(Role $role)
    {
        $role->permissions()->detach();
        return  $this->deleteById($role->id);
    }
}
