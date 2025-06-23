@extends('layouts.super-admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h1 class="page-title">System Users</h1>
                <p class="page-subtitle">Manage system administrators and super admin users</p>
            </div>
        </div>
    </div>

    <!-- User Statistics -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">15</div>
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
                                Active Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
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
                                Pending Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-clock fa-2x text-gray-300"></i>
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
                                Super Admins</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-crown fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">System Users</h6>
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add User
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Last Login</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle mr-2" src="https://ui-avatars.com/api/?name=John+Doe&background=random" width="32" height="32">
                                            <div>
                                                <div class="font-weight-bold">John Doe</div>
                                                <small class="text-muted">Super Admin</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>john.doe@example.com</td>
                                    <td><span class="badge badge-primary">Super Admin</span></td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>2 hours ago</td>
                                    <td>2024-01-15</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">Edit</button>
                                        <button class="btn btn-sm btn-outline-info">View</button>
                                        <button class="btn btn-sm btn-outline-warning">Suspend</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle mr-2" src="https://ui-avatars.com/api/?name=Jane+Smith&background=random" width="32" height="32">
                                            <div>
                                                <div class="font-weight-bold">Jane Smith</div>
                                                <small class="text-muted">Admin</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>jane.smith@example.com</td>
                                    <td><span class="badge badge-info">Admin</span></td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>1 day ago</td>
                                    <td>2024-01-10</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">Edit</button>
                                        <button class="btn btn-sm btn-outline-info">View</button>
                                        <button class="btn btn-sm btn-outline-warning">Suspend</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle mr-2" src="https://ui-avatars.com/api/?name=Mike+Johnson&background=random" width="32" height="32">
                                            <div>
                                                <div class="font-weight-bold">Mike Johnson</div>
                                                <small class="text-muted">Support</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>mike.johnson@example.com</td>
                                    <td><span class="badge badge-secondary">Support</span></td>
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    <td>Never</td>
                                    <td>2024-01-20</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">Edit</button>
                                        <button class="btn btn-sm btn-outline-info">View</button>
                                        <button class="btn btn-sm btn-outline-success">Activate</button>
                                    </td>
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