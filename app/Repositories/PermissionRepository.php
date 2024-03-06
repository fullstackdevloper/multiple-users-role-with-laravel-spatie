<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRepository extends BaseRepository
{

    public function  __construct(Permission $permission)
    {
        parent::__construct($permission);
    }


    public function addOrUpdatePermissions($payload)
    {
        $allPermissions = $this->get()->pluck('name')->toArray();
        $differentPermissions = array_diff(
            $allPermissions,
            array_values($payload['permissions'])
        );

        DB::beginTransaction();

        try {
            if (!empty($differentPermissions)) {
                $this->deleteUsingArray('name', $differentPermissions);
            }

            foreach ($payload['permissions'] as $permissionName) {
                $params = ['name' => $permissionName];
                $this->updateOrCreateByCriteria($params, $params);
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
