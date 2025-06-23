<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\SuperAdmin\DashboardController;

/*
|--------------------------------------------------------------------------
| Central Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your central application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        // your actual routes

Route::get('/', function () {
    return view('welcome');
});
Route::get('/abc', function () {
    return view('welcome');
});
// Super Admin routes
Route::middleware(['auth', 'super_admin'])->prefix('super-admin')->name('super-admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Dashboard sections
    Route::get('/analytics', [DashboardController::class, 'analytics'])->name('analytics');
    Route::get('/subscriptions', [DashboardController::class, 'subscriptions'])->name('subscriptions');
    Route::get('/users', [DashboardController::class, 'users'])->name('users');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
    Route::get('/logs', [DashboardController::class, 'logs'])->name('logs');
    Route::get('/reports', [DashboardController::class, 'reports'])->name('reports');
    Route::get('/billing', [DashboardController::class, 'billing'])->name('billing');
    
    // AJAX endpoints for dashboard
    Route::get('/dashboard/stats', [DashboardController::class, 'getStatsAjax'])->name('dashboard.stats');
    Route::get('/dashboard/activity', [DashboardController::class, 'getRecentActivityAjax'])->name('dashboard.activity');
    Route::get('/dashboard/tenants', [DashboardController::class, 'getTenantsAjax'])->name('dashboard.tenants');
    Route::get('/dashboard/charts', [DashboardController::class, 'getChartDataAjax'])->name('dashboard.charts');
    
    Route::resource('tenants', TenantController::class);
    Route::post('/tenants/draft', [TenantController::class, 'storeDraft'])->name('tenants.draft');
    Route::post('/tenants/bulk-action', [TenantController::class, 'bulkAction'])->name('tenants.bulk-action');
    Route::get('/tenants/{tenant}/transaction-status', [TenantController::class, 'getTransactionStatus'])->name('tenants.transaction-status');
    Route::get('/tenants/{tenant}/check-database', [TenantController::class, 'checkDatabaseExists'])->name('tenants.check-database');
    Route::post('/tenants/{tenant}/create-database', [TenantController::class, 'createTenantDatabase'])->name('tenants.create-database');
});

// Regular admin routes (if needed)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
    Route::get('/login', function () {
        return view('super-admin.login');
    })->name('login');

    
});
}