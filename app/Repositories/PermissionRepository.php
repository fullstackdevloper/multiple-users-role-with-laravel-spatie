<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRepository extends BaseRepository
{

    public $limit = 10;
    public function  __construct(Permission $permission)
    {
        parent::__construct($permission);
    }

    public function getAllPaginatePemissions(array $condition = [])
    {
        return $this->paginate($this->limit, $condition);
    }

    public function removePermission(Permission $permission)
    {
        $permission->roles()->detach();
        return  $this->deleteById($permission->id);
    }

    public function getAllPermissions(array $condition = [], array $relation = [])
    {
        return  $this->get($condition, $relation);
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
