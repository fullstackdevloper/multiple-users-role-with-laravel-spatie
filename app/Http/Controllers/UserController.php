<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    protected $userRepository;

    /**
     * Constructor to initialize the UserRepository.
     * 
     * @param  \App\Repositories\UserRepository  $userRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Get all users except the authenticated user
        $users = $this->userRepository->getAllPaginateUsers([['id', '!=', Auth::id()]], ['roles']);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param  \App\Http\Requests\CreateUserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(CreateUserRequest $request)
    {
        // Validate and get user data
        $user_data = $request->validated();

        // Create user
        $add_user = $this->userRepository->createUser($user_data);

        // Check if user was successfully added
        if ($add_user) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'User added successfully!']);
        } else {
            return redirect()->back()->with(['status' => 'error', 'message' => 'This email already exists!']);
        }
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function store(Request $request)
    {
        // Store a newly created resource
    }

    /**
     * Display the specified resource.
     * 
     * @param  \App\Models\User  $user
     * @return void
     */
    public function show(User $user)
    {
        // Display the specified resource
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Http\Requests\UserUpdateRequest  $userUpdateRequest
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $userUpdateRequest, User $user)
    {
        // Update the user
        $users = $this->userRepository->updateUser($user->id, $userUpdateRequest->all());
        return redirect()->route('users.list')->with(['status' => 'success', 'message' => 'User updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  string  $id
     * @return void
     */
    public function destroy(string $id)
    {
        // Remove the specified resource from storage
    }

    /**
     * Show the form for adding a new user.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function addUser()
    {
        // Get all roles and permissions
        $all_roles = Role::all();
        $permissions = Permission::all();

        return view('users.add', compact('all_roles', 'permissions'));
    }
}
