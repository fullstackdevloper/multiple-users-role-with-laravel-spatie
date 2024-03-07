<?php

namespace App\Http\Controllers;

use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    protected $permissionRepository;
    protected $limit = 10;

    /**
     * Constructor to initialize the PermissionRepository.
     * 
     * @param  \App\Repositories\PermissionRepository  $permissionRepository
     * @return void
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $permissions = $this->permissionRepository->paginate($this->limit);
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $permissions = $this->permissionRepository->get();
        return view('permissions.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->permissionRepository->addOrUpdatePermissions($request->all());
        return redirect()->back()->with(['status' => 'success', 'message' => 'Permission added successfully!']);
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
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Permission $permission)
    {
        return  view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return void
     */
    public function update(Request $request, string $id)
    {
        // Update the specified resource in storage
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Permission $permission)
    {
        $deleted = $this->permissionRepository->deleteById($permission->id);
        return redirect()->back()->with(['status' => 'success', 'message' => 'Permission removed successfully!']);
    }
}
