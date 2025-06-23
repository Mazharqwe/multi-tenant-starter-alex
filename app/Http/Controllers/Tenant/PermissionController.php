<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Permission;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::latest()->paginate(15);
        return view('tenant.pages.permissions', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenant.pages.permissions');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'description' => 'nullable|string|max:255',
        ]);
        $permission = Permission::create($validated);
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Permission created successfully',
                'permission' => $permission
            ]);
        }
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('tenant.pages.permissions');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'permission' => $permission
            ]);
        }
        return view('tenant.pages.permissions', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('permissions')->ignore($permission->id)],
            'description' => 'nullable|string|max:255',
        ]);
        $permission->update($validated);
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Permission updated successfully',
                'permission' => $permission
            ]);
        }
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Permission deleted successfully'
            ]);
        }
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully!');
    }

    /**
     * Update permission roles
     */
    public function updateRoles(Request $request, $id)
    {
        $validated = $request->validate([
            'roles' => 'required|array'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permission roles updated successfully'
        ]);
    }
} 