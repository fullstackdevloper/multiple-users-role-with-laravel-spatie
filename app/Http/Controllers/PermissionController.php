<?php

namespace App\Http\Controllers;

use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    protected $permissionRepository;
    protected $limit = 10;
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = $this->permissionRepository->paginate($this->limit);
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = $this->permissionRepository->get();
        return view('permissions.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->permissionRepository->addOrUpdatePermissions($request->all());
        return redirect()->back()->with(['status' => 'success', 'message' => 'Permission added successfully!']);
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
    public function edit(Permission $permission)
    {
        return  view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $deleted = $this->permissionRepository->deleteById($permission->id);
        return redirect()->back()->with(['status' => 'success', 'message' => 'Permission removed successfully!']);
    }
}
