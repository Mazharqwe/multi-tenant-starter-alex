<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Staff;
use App\Models\Tenant\User;
use App\Models\Tenant\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::with(['user'])
            ->withCount(['appointments', 'services'])
            ->latest()
            ->paginate(15);

        // Data for modals
        $services = Service::where('is_active', true)->get();

        return view('tenant.pages.staff', compact('staff', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::where('is_active', true)->get();
        return view('tenant.pages.staff', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'position' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'hire_date' => 'nullable|date',
            'is_active' => 'boolean',
            'bio' => 'nullable|string',
            'password' => 'required|string|min:8',
            'services' => 'array',
        ]);

        // Create user first
        $user = User::create([
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'role' => 'staff',
            'is_active' => $validated['is_active'],
            'password' => Hash::make($validated['password']),
        ]);

        // Create staff member
        $staff = Staff::create([
            'user_id' => $user->id,
            'position' => $validated['position'],
            'specialization' => $validated['specialization'],
            'hire_date' => $validated['hire_date'],
            'is_active' => $validated['is_active'],
            'bio' => $validated['bio'],
        ]);

        // Attach services if provided
        if (!empty($validated['services'])) {
            $staff->services()->attach($validated['services']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Staff member created successfully',
            'staff' => $staff->load('user')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        $staff->load(['user', 'services', 'appointments.service']);
        return view('tenant.pages.staff', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        $services = Service::where('is_active', true)->get();
        $staff->load(['user', 'services']);
        return view('tenant.pages.staff', compact('staff', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $staff->user_id,
            'phone' => 'nullable|string|max:20',
            'position' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'hire_date' => 'nullable|date',
            'is_active' => 'boolean',
            'bio' => 'nullable|string',
            'password' => 'nullable|string|min:8',
            'services' => 'array',
        ]);

        // Update user
        $userData = [
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'is_active' => $validated['is_active'],
        ];

        if (!empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $staff->user->update($userData);

        // Update staff member
        $staff->update([
            'position' => $validated['position'],
            'specialization' => $validated['specialization'],
            'hire_date' => $validated['hire_date'],
            'is_active' => $validated['is_active'],
            'bio' => $validated['bio'],
        ]);

        // Sync services
        if (isset($validated['services'])) {
            $staff->services()->sync($validated['services']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Staff member updated successfully',
            'staff' => $staff->load('user')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
        $staff->user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Staff member deleted successfully'
        ]);
    }

    /**
     * Show staff schedule
     */
    public function schedule(Staff $staff)
    {
        $staff->load(['appointments.service', 'appointments.customer']);
        return view('tenant.pages.staff-schedule', compact('staff'));
    }
} 