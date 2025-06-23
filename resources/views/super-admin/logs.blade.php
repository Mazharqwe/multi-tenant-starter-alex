@extends('layouts.super-admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h1 class="page-title">System Logs</h1>
                <p class="page-subtitle">Monitor system activity and error logs</p>
            </div>
        </div>
    </div>

    <!-- Log Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <form class="row">
                        <div class="col-md-3">
                            <label for="logLevel">Log Level</label>
                            <select class="form-control" id="logLevel">
                                <option value="">All Levels</option>
                                <option value="error">Error</option>
                                <option value="warning">Warning</option>
                                <option value="info">Info</option>
                                <option value="debug">Debug</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="logDate">Date Range</label>
                            <select class="form-control" id="logDate">
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="week">Last 7 Days</option>
                                <option value="month">Last 30 Days</option>
                                <option value="custom">Custom Range</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="logSearch">Search</label>
                            <input type="text" class="form-control" id="logSearch" placeholder="Search logs...">
                        </div>
                        <div class="col-md-3">
                            <label>&nbsp;</label>
                            <div>
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <button type="button" class="btn btn-secondary">Clear</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Log Statistics -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Errors</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
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
                                Warnings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">25</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
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
                                Info Logs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">1,234</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-info-circle fa-2x text-gray-300"></i>
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
                                System Uptime</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">99.9%</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-server fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logs Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">System Logs</h6>
                    <div>
                        <button class="btn btn-success btn-sm">
                            <i class="fas fa-download"></i> Export
                        </button>
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Clear Logs
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Timestamp</th>
                                    <th>Level</th>
                                    <th>Message</th>
                                    <th>Context</th>
                                    <th>User</th>
                                    <th>IP Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2024-01-20 14:30:25</td>
                                    <td><span class="badge badge-danger">ERROR</span></td>
                                    <td>Database connection failed</td>
                                    <td>Database</td>
                                    <td>john.doe@example.com</td>
                                    <td>192.168.1.100</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-info">View Details</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2024-01-20 14:28:15</td>
                                    <td><span class="badge badge-warning">WARNING</span></td>
                                    <td>High memory usage detected</td>
                                    <td>System</td>
                                    <td>system</td>
                                    <td>127.0.0.1</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-info">View Details</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2024-01-20 14:25:42</td>
                                    <td><span class="badge badge-info">INFO</span></td>
                                    <td>New tenant registered: Acme Corp</td>
                                    <td>Tenant</td>
                                    <td>admin@example.com</td>
                                    <td>192.168.1.101</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-info">View Details</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2024-01-20 14:20:18</td>
                                    <td><span class="badge badge-info">INFO</span></td>
                                    <td>User login successful</td>
                                    <td>Auth</td>
                                    <td>jane.smith@example.com</td>
                                    <td>192.168.1.102</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-info">View Details</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2024-01-20 14:15:33</td>
                                    <td><span class="badge badge-danger">ERROR</span></td>
                                    <td>Payment processing failed</td>
                                    <td>Payment</td>
                                    <td>mike.johnson@example.com</td>
                                    <td>192.168.1.103</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-info">View Details</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <nav aria-label="Log pagination">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 