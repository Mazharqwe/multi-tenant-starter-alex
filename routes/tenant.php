<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Tenant\AppointmentController;
use App\Http\Controllers\Tenant\ServiceController;
use App\Http\Controllers\Tenant\StaffController;
use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\UserController;
use App\Http\Controllers\Tenant\RoleController;
use App\Http\Controllers\Tenant\PermissionController;

/*
|--------------------------------------------------------------------------
| Tenant Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your tenant application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/abc', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    Route::middleware(['auth'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/', [DashboardController::class, 'index'])->name('home');

        // Users (Customers)
        Route::resource('users', UserController::class);
        Route::patch('/users/{user}/status', [UserController::class, 'updateStatus'])->name('users.updateStatus');
        Route::get('/users-list', [UserController::class, 'getUsers'])->name('users.list');
        Route::patch('/users/bulk-activate', [UserController::class, 'bulkActivate'])->name('users.bulkActivate');
        Route::patch('/users/bulk-deactivate', [UserController::class, 'bulkDeactivate'])->name('users.bulkDeactivate');
        Route::delete('/users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulkDelete');

        // Roles
        Route::resource('roles', RoleController::class);
        Route::patch('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.update-permissions');

        // Permissions
        Route::resource('permissions', PermissionController::class);
        Route::patch('permissions/{permission}/roles', [PermissionController::class, 'updateRoles'])->name('permissions.update-roles');

        // Appointments
        Route::resource('appointments', AppointmentController::class);
        Route::patch('appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.update-status');

        // Services
        Route::resource('services', ServiceController::class);

        // Staff
        Route::resource('staff', StaffController::class);
        Route::resource('staff.working-hours', StaffController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::get('staff/{staff}/schedule', [StaffController::class, 'schedule'])->name('staff.schedule');

        // Admin only routes
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
        });
    });
    
    require __DIR__.'/auth.php';
    
    Route::get('/login', function () {
        return view('tenant.login');
    })->name('login');
});


