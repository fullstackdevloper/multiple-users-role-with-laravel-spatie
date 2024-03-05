<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository
{

    public $limit = 10;
    public function  __construct(Role $role)
    {
        parent::__construct($role);
    }

    public function getAllPaginateRoles(array $condition = [], array $withRelation)
    {
        return $this->paginate($this->limit, $condition, $withRelation);
    }
}
