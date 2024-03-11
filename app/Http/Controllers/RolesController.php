<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\UpdateRolePermission;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    protected $roleRepository;
    protected $limit = 10;

    /**
     * Constructor to initialize the RoleRepository.
     * 
     * @param  \App\Repositories\RoleRepository  $roleRepository
     * @return void
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $roles = $this->roleRepository->paginate($this->limit);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \App\Http\Requests\RoleCreateRequest  $roleCreateRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleCreateRequest $roleCreateRequest)
    {
        $this->roleRepository->createRole($roleCreateRequest->all());
        return redirect()->route('roles.list')->with(['status' => 'success', 'message' => 'Role added successfully!']);
    }

    /**
     * Display the specified resource.
     * 
     * @param  string  $id
     * @return void
     */
    public function show(string $id)
    {
        // Show the specified resource
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Http\Requests\UpdateRolePermission  $updateRolePermission
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRolePermission $updateRolePermission, Role $role)
    {
        $this->roleRepository->updateRole($role->id, $updateRolePermission->all());
        return redirect()->route('roles.list')->with(['status' => 'success', 'message' => 'Role and Permission updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        $deleted = $this->roleRepository->deleteById($role->id);
        return redirect()->route('roles.list')->with(['status' => 'success', 'message' => 'Role removed successfully!']);
    }
}
