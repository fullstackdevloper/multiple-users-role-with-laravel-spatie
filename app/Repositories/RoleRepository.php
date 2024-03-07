<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository
{
    /**
     * Default limit for pagination.
     * 
     * @var int
     */
    public $limit = 10;

    /**
     * Constructor to initialize the Role model.
     * 
     * @param  \Spatie\Permission\Models\Role  $role
     * @return void
     */
    public function  __construct(Role $role)
    {
        parent::__construct($role);
    }

    /**
     * Update a role with the given ID and payload.
     * 
     * @param  int  $roleId
     * @param  array  $payload
     * @return \Spatie\Permission\Models\Role|null
     */
    public function updateRole($roleId, array $payload = [])
    {
        $role =  $this->updateByCriteria(['id' => $roleId], ['name' => $payload['name']]);

        // Sync permissions for the updated role
        if ($role) {
            $role->syncPermissions($payload['permissions']);
        }

        return $role;
    }

    /**
     * Create a new role with the given payload.
     * 
     * @param  array  $payload
     * @return \Spatie\Permission\Models\Role|null
     */
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
