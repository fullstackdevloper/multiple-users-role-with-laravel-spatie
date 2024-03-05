<?php

namespace App\Repositories;

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
        foreach ($payload['permissions'] as $permissionName) {
            $params = ['name' => $permissionName];
            $this->updateOrCreateByCriteria($params, $params);
        }
        return true;
    }
}
