<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    /**
     * Default limit for pagination.
     * 
     * @var int
     */
    public $limit = 10;

    /**
     * Constructor to initialize the User model.
     * 
     * @param  \App\Models\User  $user
     * @return void
     */
    public function  __construct(User $user)
    {
        parent::__construct($user);
    }


    /**
     * Retrieve and paginate all users with optional conditions and relations.
     *
     * @param  array  $condition
     * @param  array  $relations
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPaginateUsers(array $condition = [], array $relations = [])
    {
        // Paginate users with the specified limit, conditions, and relations
        return $this->paginate(
            $this->limit,
            $condition,
            $relations
        );
    }


    /**
     * Update a user's information.
     *
     * @param  int  $userId
     * @param  array  $payload
     * @return \App\Models\User|null
     */
    public function updateUser($userId, array $payload = [])
    {
        // Update user by criteria (ID) with new email and name
        $user =  $this->updateByCriteria(['id' => $userId], [
            'email' => $payload['email'],
            'name' => $payload['name']
        ]);

        // Sync roles for the updated user
        if ($user) {
            $user->syncRoles($payload['roles']);
        }

        return $user;
    }


    /**
     * Create a new user.
     *
     * @param  array  $user_data
     * @return \App\Models\User|null
     */
    public function createUser($user_data)
    {
        // Create a new user with the provided data
        $user = $this->create([
            'name'     => $user_data['name'],
            'email'    => $user_data['email'],
            'password' => Hash::make($user_data['password'])
        ]);

        // Sync roles for the newly created user
        $user->syncRoles($user_data['roles']);

        return $user;
    }
}
