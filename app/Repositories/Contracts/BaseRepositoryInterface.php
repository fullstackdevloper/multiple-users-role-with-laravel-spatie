<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryInterface
{
    public function all();

    public function get(array $conditions, array $relations);
    
    public function paginate(int $perPage, array $conditions, array $relations);
    
    public function find(int $id);

    public function findByUuid(string $id);

    public function create(array $data);

    public function deleteById(int $id);

    public function deleteByUuid(string $uuid);
}
