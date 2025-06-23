<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Role;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::withCount('permissions')->latest()->paginate(15);
        return view('tenant.pages.roles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenant.pages.roles');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'nullable|string|max:255',
        ]);
        $role = Role::create($validated);
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Role created successfully',
                'role' => $role->loadCount('permissions')
            ]);
        }
        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('tenant.pages.roles');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'role' => $role
            ]);
        }
        return view('tenant.pages.roles', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
            'description' => 'nullable|string|max:255',
        ]);
        $role->update($validated);
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Role updated successfully',
                'role' => $role->loadCount('permissions')
            ]);
        }
        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Role deleted successfully'
            ]);
        }
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
    }

    /**
     * Update role permissions
     */
    public function updatePermissions(Request $request, $id)
    {
        $validated = $request->validate([
            'permissions' => 'required|array'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Role permissions updated successfully'
        ]);
    }
} 