@extends('layouts.super-admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div class="d-flex align-items-center">
                    <div class="me-4">
                        <div class="bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <span class="h4 mb-0 fw-bold">{{ strtoupper(substr($tenant->name, 0, 2)) }}</span>
                        </div>
                    </div>
                    <div>
                        <h1 class="page-title">{{ $tenant->name }}</h1>
                        <p class="page-subtitle">Tenant ID: {{ $tenant->id }} • Created {{ $tenant->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Status Banner -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span class="badge {{ $tenant->is_active ? 'bg-success' : 'bg-danger' }} me-3">
                                <i class="fas fa-circle me-1"></i>
                                {{ $tenant->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            <span class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                Created {{ $tenant->created_at->format('M d, Y') }}
                            </span>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('super-admin.tenants.edit', $tenant) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit me-1"></i>Edit Tenant
                            </a>
                            @if($tenant->domains->count() > 0)
                                <a href="http://{{ $tenant->domains->first()->domain }}" target="_blank" class="btn btn-info btn-sm">
                                    <i class="fas fa-external-link-alt me-1"></i>Visit Site
                                </a>
                            @endif
                            <a href="{{ route('super-admin.tenants.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Back to Tenants
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Basic Information -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-building me-2"></i>Basic Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong class="text-muted">Company Name:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $tenant->name }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong class="text-muted">Email Address:</strong>
                        </div>
                        <div class="col-sm-8">
                            <a href="mailto:{{ $tenant->admin_email }}" class="text-decoration-none">
                                {{ $tenant->admin_email }}
                            </a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong class="text-muted">Phone Number:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $tenant->admin_phone ?? 'Not provided' }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong class="text-muted">Address:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $tenant->admin_address ?? 'Not provided' }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <strong class="text-muted">Status:</strong>
                        </div>
                        <div class="col-sm-8">
                            <span class="badge {{ $tenant->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $tenant->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Domain Information -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-globe me-2"></i>Domain Information
                    </h6>
                </div>
                <div class="card-body">
                    @if($tenant->domains->count() > 0)
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong class="text-muted">Primary Domain:</strong>
                            </div>
                            <div class="col-sm-8">
                                <a href="http://{{ $tenant->domains->first()->domain }}" target="_blank" class="text-decoration-none">
                                    {{ $tenant->domains->first()->domain }}
                                    <i class="fas fa-external-link-alt ms-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong class="text-muted">Domain Status:</strong>
                            </div>
                            <div class="col-sm-8">
                                <span class="badge bg-success">Active</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <strong class="text-muted">Total Domains:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $tenant->domains->count() }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-globe fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No domain configured for this tenant</p>
                            <a href="{{ route('super-admin.tenants.edit', $tenant) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-1"></i>Add Domain
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">25</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Services</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cogs fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Appointments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">156</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$2,450</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-history me-2"></i>Recent Activity
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Activity</th>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <i class="fas fa-user-plus text-success me-2"></i>
                                        New user registered
                                    </td>
                                    <td>john.doe@company.com</td>
                                    <td>2 hours ago</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="fas fa-calendar-plus text-info me-2"></i>
                                        Appointment scheduled
                                    </td>
                                    <td>jane.smith@company.com</td>
                                    <td>4 hours ago</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="fas fa-cog text-warning me-2"></i>
                                        Service updated
                                    </td>
                                    <td>admin@company.com</td>
                                    <td>1 day ago</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="fas fa-credit-card text-primary me-2"></i>
                                        Payment received
                                    </td>
                                    <td>system</td>
                                    <td>2 days ago</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 