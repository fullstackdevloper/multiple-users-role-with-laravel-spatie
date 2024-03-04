<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{

    public $limit = 10;
    public function  __construct(User $user)
    {
        parent::__construct($user);
    }

    public function getAllPaginateUsers(array $condition = [], array $relations = [])
    {
        return $this->paginate($this->limit, $condition, $relations);
    }

    public function updateUser($userId, array $payload = [])
    {
        $user =  $this->updateByCriteria(['id' => $userId], ['email' => $payload['email'], 'name' => $payload['name']]);
        if($user) {
            $user->syncRoles($payload['roles']);
        }
        return $user;
    }
}
