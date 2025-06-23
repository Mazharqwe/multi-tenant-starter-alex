<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_tenants' => Tenant::count(),
            'active_tenants' => Tenant::where('is_active', true)->count(),
            'monthly_revenue' => 15000, // Placeholder
            'total_users' => 250, // Placeholder
        ];

        $recentActivity = [
            [
                'icon' => 'fas fa-plus',
                'color' => 'bg-success',
                'title' => 'New Tenant Created',
                'description' => 'Acme Corp has been added to the platform',
                'time' => '2 minutes ago'
            ],
            [
                'icon' => 'fas fa-user',
                'color' => 'bg-info',
                'title' => 'User Registration',
                'description' => 'John Doe registered for TechStart Inc',
                'time' => '15 minutes ago'
            ],
            [
                'icon' => 'fas fa-credit-card',
                'color' => 'bg-warning',
                'title' => 'Payment Received',
                'description' => 'Monthly subscription payment from GlobalTech',
                'time' => '1 hour ago'
            ],
            [
                'icon' => 'fas fa-cog',
                'color' => 'bg-primary',
                'title' => 'System Update',
                'description' => 'Platform updated to version 2.1.0',
                'time' => '3 hours ago'
            ]
        ];

        $chartData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'tenant_growth' => [10, 15, 22, 28, 35, 42],
            'active_tenants' => [8, 12, 18, 24, 30, 38],
            'subscription_plans' => [
                'Basic' => 25,
                'Pro' => 12,
                'Enterprise' => 5
            ]
        ];

        $recentTenants = Tenant::with('domains')->latest()->take(5)->get();

        return view('super-admin.dashboard', compact('stats', 'recentActivity', 'chartData', 'recentTenants'));
    }

    public function analytics()
    {
        return view('super-admin.analytics');
    }

    public function subscriptions()
    {
        return view('super-admin.subscriptions');
    }

    public function users()
    {
        return view('super-admin.users');
    }

    public function settings()
    {
        return view('super-admin.settings');
    }

    public function logs()
    {
        return view('super-admin.logs');
    }

    public function reports()
    {
        return view('super-admin.reports');
    }

    public function billing()
    {
        return view('super-admin.billing');
    }

    // AJAX endpoints for dashboard
    public function getStatsAjax()
    {
        $stats = [
            'total_tenants' => Tenant::count(),
            'active_tenants' => Tenant::where('is_active', true)->count(),
            'monthly_revenue' => 15000,
            'total_users' => 250,
        ];

        return response()->json($stats);
    }

    public function getRecentActivityAjax()
    {
        $activity = [
            [
                'icon' => 'fas fa-plus',
                'color' => 'bg-success',
                'title' => 'New Tenant Created',
                'description' => 'Acme Corp has been added to the platform',
                'time' => '2 minutes ago'
            ],
            [
                'icon' => 'fas fa-user',
                'color' => 'bg-info',
                'title' => 'User Registration',
                'description' => 'John Doe registered for TechStart Inc',
                'time' => '15 minutes ago'
            ]
        ];

        return response()->json($activity);
    }

    public function getTenantsAjax()
    {
        $tenants = Tenant::with('domains')->latest()->take(10)->get();
        return response()->json($tenants);
    }

    public function getChartDataAjax()
    {
        $chartData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'tenant_growth' => [10, 15, 22, 28, 35, 42],
            'active_tenants' => [8, 12, 18, 24, 30, 38],
            'subscription_plans' => [
                'Basic' => 25,
                'Pro' => 12,
                'Enterprise' => 5
            ]
        ];

        return response()->json($chartData);
    }
} 