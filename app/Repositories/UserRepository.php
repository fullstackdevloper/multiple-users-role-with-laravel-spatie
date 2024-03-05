<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
    public function createUser($user_data){

        $existingUser = User::where('email', $user_data['email'])->first();
        if($existingUser){
             return false;
        }else{
            $user = new User;
            $user->name = $user_data['name'];
            $user->email = $user_data['email'];
            $user->password = Hash::make($user_data['password']);
            $user->save();
            
            return $user;

        }
        
    }
}
