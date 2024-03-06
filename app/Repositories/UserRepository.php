<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    // Default limit for pagination
    public $limit = 10;

    // Constructor to initialize the User model
    public function  __construct(User $user)
    {
        parent::__construct($user);
    }

    // Get all users paginated with conditions and relations
    public function getAllPaginateUsers(array $condition = [], array $relations = [])
    {
        return $this->paginate($this->limit, $condition, $relations);
    }

    // Update a user with given ID and payload
    public function updateUser($userId, array $payload = [])
    {
        // Update user by criteria (ID) with new email and name
        $user =  $this->updateByCriteria(['id' => $userId], ['email' => $payload['email'], 'name' => $payload['name']]);

        // Sync roles for the updated user
        if ($user) {
            $user->syncRoles($payload['roles']);
        }
        return $user;
    }
    public function createUser($user_data){

       
            $user = $this->create(['name'=>$user_data['name'], 'email'=>$user_data['email'],'password'=>Hash::make($user_data['password'])]);
            $user->syncRoles($user_data['roles']);
            return $user;

        
        
    }
}
