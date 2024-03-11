<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository
{
    /**
     * Construct a new PermissionRepository instance.
     *
     * @param  Permission  $permission
     * @return void
     */
    public function  __construct(Permission $permission)
    {
        parent::__construct($permission);
    }

    /**
     * Add or update permissions.
     *
     * @param  array  $payload
     * @return bool
     * @throws \Exception
     */
    public function addOrUpdatePermissions($payload)
    {
        // Retrieve all existing permissions
        $allPermissions = $this->get()->pluck('name')->toArray();
        // Determine which permissions need to be deleted
        $differentPermissions = array_diff(
            $allPermissions,
            array_values($payload['permissions'])
        );

        DB::beginTransaction();

        try {
            // Delete permissions that are not in the payload
            if (!empty($differentPermissions)) {
                $this->deleteUsingArray('name', $differentPermissions);
            }

            // Add or update permissions from the payload
            foreach ($payload['permissions'] as $permissionName) {
                $params = ['name' => $permissionName];
                $this->updateOrCreateByCriteria($params, $params);
            }

            // Commit the transaction
            DB::commit();

            return true;
        } catch (\Exception $e) {
            // Rollback the transaction in case of exception
            DB::rollBack();
            throw $e;
        }
    }
}
