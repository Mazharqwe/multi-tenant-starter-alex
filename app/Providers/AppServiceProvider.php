<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register Super Admin Components
        Blade::component('super-admin.stat-card', \App\View\Components\SuperAdmin\StatCard::class);
        Blade::component('super-admin.activity-item', \App\View\Components\SuperAdmin\ActivityItem::class);
        Blade::component('super-admin.quick-action-btn', \App\View\Components\SuperAdmin\QuickActionBtn::class);
        Blade::component('super-admin.tenant-row', \App\View\Components\SuperAdmin\TenantRow::class);
    }
}
