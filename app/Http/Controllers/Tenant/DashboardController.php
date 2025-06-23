<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Appointment;
use App\Models\Tenant\Service;
use App\Models\Tenant\Staff;
use App\Models\Tenant\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'confirmed_appointments' => Appointment::where('status', 'confirmed')->count(),
            'cancelled_appointments' => Appointment::where('status', 'cancelled')->count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'total_staff' => Staff::where('is_active', true)->count(),
            'total_services' => Service::where('is_active', true)->count(),
        ];

        $recent_appointments = Appointment::with(['customer', 'staff.user', 'service'])
            ->latest()
            ->take(5)
            ->get();

        return view('tenant.dashboard', compact('stats', 'recent_appointments'));
    }

    public function settings()
    {
        return view('tenant.settings');
    }
} 