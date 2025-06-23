@extends('layouts.super-admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h1 class="page-title">Subscription Management</h1>
                <p class="page-subtitle">Manage tenant subscriptions and billing plans</p>
            </div>
        </div>
    </div>

    <!-- Subscription Plans -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Subscription Plans</h6>
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add Plan
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Plan Name</th>
                                    <th>Price</th>
                                    <th>Features</th>
                                    <th>Active Tenants</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Basic</strong></td>
                                    <td>$99/month</td>
                                    <td>5 Users, Basic Support</td>
                                    <td>25</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Pro</strong></td>
                                    <td>$199/month</td>
                                    <td>25 Users, Priority Support</td>
                                    <td>12</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Enterprise</strong></td>
                                    <td>$499/month</td>
                                    <td>Unlimited Users, 24/7 Support</td>
                                    <td>5</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">Edit</button>
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

    <!-- Active Subscriptions -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Active Subscriptions</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tenant</th>
                                    <th>Plan</th>
                                    <th>Start Date</th>
                                    <th>Next Billing</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Acme Corp</td>
                                    <td>Pro</td>
                                    <td>2024-01-15</td>
                                    <td>2024-02-15</td>
                                    <td>$199.00</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-info">View</button>
                                        <button class="btn btn-sm btn-outline-warning">Suspend</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>TechStart Inc</td>
                                    <td>Basic</td>
                                    <td>2024-01-10</td>
                                    <td>2024-02-10</td>
                                    <td>$99.00</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-info">View</button>
                                        <button class="btn btn-sm btn-outline-warning">Suspend</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>GlobalTech</td>
                                    <td>Enterprise</td>
                                    <td>2024-01-01</td>
                                    <td>2024-02-01</td>
                                    <td>$499.00</td>
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    <td>
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