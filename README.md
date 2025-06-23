<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Multi Tenant

This project is a multi-tenant SaaS platform built with Laravel. It is designed to allow a super admin to manage multiple tenants (companies/organizations), each with their own isolated data, users, and resources. The system uses the stancl/tenancy package to provide robust multi-tenancy features, including separate databases for each tenant.
### Key Features
### Super Admin Panel:
Manage all tenants from a central dashboard.
Create, edit, activate/deactivate, and delete tenants.
View analytics, billing, logs, reports, and user management for all tenants.
### Tenant Management:
Each tenant has its own subdomain (e.g., tenant1.yourapp.com).
When a new tenant is created, a separate database is provisioned for them.
Tenant-specific resources: appointments, staff, services, roles, permissions, users, and working hours.
### User Management:
Super admin can manage users across all tenants.
Each tenant manages its own users, roles, and permissions.
### Automated Database Provisioning:
When a tenant is created, the system automatically creates a new database, runs migrations, and seeds initial data for that tenant.
This is handled manually in the controller to avoid transaction issues.
Modern UI:
Uses Blade templates for clean, responsive, and modern user interfaces.
Includes dashboards, modals, tables, and forms for both super admin and tenant users.
### Queue Support:
Supports asynchronous job processing for tasks like database creation (can be run synchronously or via queue).
Technical Stack
Backend: Laravel 12.x
Multi-Tenancy: stancl/tenancy (v3.9)
Frontend: Blade templates, Bootstrap, custom JS
Database: MySQL (or other supported by Laravel)
Queue: Database driver (can be switched to Redis, etc.)
Authentication: Laravel Sanctum
### Directory Structure Highlights
app/Http/Controllers/SuperAdmin/ — Controllers for super admin features.
app/Http/Controllers/Tenant/ — Controllers for tenant-specific features.
app/Models/Tenant.php — Tenant model, extended for multi-tenancy.
database/migrations/tenant/ — Migrations that are run for each tenant’s database.
resources/views/super-admin/ — Super admin UI.
resources/views/tenant/ — Tenant UI.
app/Providers/TenancyServiceProvider.php — Customizes tenancy event handling.
### How Tenant Creation Works
Super admin creates a tenant via the dashboard.
Central record is created in the main database.
A new database is provisioned for the tenant.
Migrations and seeders are run to set up the tenant’s schema and initial data.
Tenant gets their own subdomain and can log in to manage their business.
### Use Cases
SaaS platforms for appointment booking, CRM, HRM, or any business where each client needs isolated data and resources.
Agencies or companies managing multiple brands or clients from a single codebase.


