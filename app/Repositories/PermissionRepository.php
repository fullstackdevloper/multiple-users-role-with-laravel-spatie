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
}
