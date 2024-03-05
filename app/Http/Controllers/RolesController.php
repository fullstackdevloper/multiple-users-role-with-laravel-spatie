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
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->roleRepository->getAllPaginateRoles([], ['permissions']);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleCreateRequest $roleCreateRequest)
    {
        $this->roleRepository->createRole($roleCreateRequest->all());
        return redirect()->route('roles.list')->with(['status' => 'success', 'message' => 'Role added successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRolePermission $updateRolePermission, Role $role)
    {
        $this->roleRepository->updateRole($role->id, $updateRolePermission->all());
        return redirect()->route('roles.list')->with(['status' => 'success', 'message' => 'Role and Permission updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->roleRepository->removeRole($role);
        return redirect()->route('roles.list')->with(['status' => 'success', 'message' => 'Role removed successfully!']);
    }
}
