@extends('layouts.super-admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h1 class="page-title">Reports & Analytics</h1>
                <p class="page-subtitle">Generate and view comprehensive reports</p>
            </div>
        </div>
    </div>

    <!-- Report Types -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Generate Reports</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="card border-left-primary h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
                                    <h5>Tenant Growth</h5>
                                    <p class="text-muted">Track tenant acquisition and growth trends</p>
                                    <button class="btn btn-primary btn-sm">Generate</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-left-success h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-dollar-sign fa-3x text-success mb-3"></i>
                                    <h5>Revenue Report</h5>
                                    <p class="text-muted">Monthly revenue and subscription analytics</p>
                                    <button class="btn btn-success btn-sm">Generate</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-left-info h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-users fa-3x text-info mb-3"></i>
                                    <h5>User Activity</h5>
                                    <p class="text-muted">User engagement and activity metrics</p>
                                    <button class="btn btn-info btn-sm">Generate</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-left-warning h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-server fa-3x text-warning mb-3"></i>
                                    <h5>System Performance</h5>
                                    <p class="text-muted">System health and performance metrics</p>
                                    <button class="btn btn-warning btn-sm">Generate</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Reports -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Reports</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Report Name</th>
                                    <th>Type</th>
                                    <th>Generated By</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Monthly Revenue Report - January 2024</td>
                                    <td><span class="badge badge-success">Revenue</span></td>
                                    <td>john.doe@example.com</td>
                                    <td>2024-01-20 10:30 AM</td>
                                    <td><span class="badge badge-success">Completed</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                        <button class="btn btn-sm btn-outline-success">Download</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tenant Growth Analysis - Q4 2023</td>
                                    <td><span class="badge badge-primary">Growth</span></td>
                                    <td>jane.smith@example.com</td>
                                    <td>2024-01-19 02:15 PM</td>
                                    <td><span class="badge badge-success">Completed</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                        <button class="btn btn-sm btn-outline-success">Download</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>System Performance Report</td>
                                    <td><span class="badge badge-warning">Performance</span></td>
                                    <td>system</td>
                                    <td>2024-01-18 11:45 PM</td>
                                    <td><span class="badge badge-success">Completed</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                        <button class="btn btn-sm btn-outline-success">Download</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>User Activity Report - December 2023</td>
                                    <td><span class="badge badge-info">Activity</span></td>
                                    <td>mike.johnson@example.com</td>
                                    <td>2024-01-17 09:20 AM</td>
                                    <td><span class="badge badge-warning">Processing</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary" disabled>Processing...</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scheduled Reports -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Scheduled Reports</h6>
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Schedule Report
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Report Name</th>
                                    <th>Frequency</th>
                                    <th>Recipients</th>
                                    <th>Next Run</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Weekly Revenue Summary</td>
                                    <td>Weekly (Monday)</td>
                                    <td>admin@example.com, finance@example.com</td>
                                    <td>2024-01-22 09:00 AM</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">Edit</button>
                                        <button class="btn btn-sm btn-outline-warning">Pause</button>
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Monthly System Health</td>
                                    <td>Monthly (1st)</td>
                                    <td>admin@example.com</td>
                                    <td>2024-02-01 06:00 AM</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">Edit</button>
                                        <button class="btn btn-sm btn-outline-warning">Pause</button>
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Daily Error Summary</td>
                                    <td>Daily</td>
                                    <td>dev@example.com</td>
                                    <td>2024-01-21 08:00 AM</td>
                                    <td><span class="badge badge-secondary">Paused</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">Edit</button>
                                        <button class="btn btn-sm btn-outline-success">Resume</button>
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
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