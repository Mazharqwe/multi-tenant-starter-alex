@extends('layouts.super-admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h1 class="page-title">Billing & Invoices</h1>
                <p class="page-subtitle">Manage billing, invoices, and payment processing</p>
            </div>
        </div>
    </div>

    <!-- Billing Overview -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Monthly Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$45,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
                                Paid Invoices</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">42</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
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
                                Pending Payments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">8</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Overdue Invoices</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Invoices -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Invoices</h6>
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Create Invoice
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Invoice #</th>
                                    <th>Tenant</th>
                                    <th>Amount</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>INV-2024-001</td>
                                    <td>Acme Corp</td>
                                    <td>$199.00</td>
                                    <td>2024-02-15</td>
                                    <td><span class="badge badge-success">Paid</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                        <button class="btn btn-sm btn-outline-success">Download</button>
                                        <button class="btn btn-sm btn-outline-info">Send</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>INV-2024-002</td>
                                    <td>TechStart Inc</td>
                                    <td>$99.00</td>
                                    <td>2024-02-10</td>
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                        <button class="btn btn-sm btn-outline-success">Download</button>
                                        <button class="btn btn-sm btn-outline-info">Send</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>INV-2024-003</td>
                                    <td>GlobalTech</td>
                                    <td>$499.00</td>
                                    <td>2024-02-01</td>
                                    <td><span class="badge badge-danger">Overdue</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                        <button class="btn btn-sm btn-outline-success">Download</button>
                                        <button class="btn btn-sm btn-outline-warning">Remind</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>INV-2024-004</td>
                                    <td>Innovate Solutions</td>
                                    <td>$299.00</td>
                                    <td>2024-02-20</td>
                                    <td><span class="badge badge-info">Draft</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">Edit</button>
                                        <button class="btn btn-sm btn-outline-success">Send</button>
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

    <!-- Payment Methods -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Payment Methods</h6>
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add Payment Method
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card border-left-success h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title">Stripe</h6>
                                            <p class="card-text text-muted">Credit Card Processing</p>
                                            <span class="badge badge-success">Active</span>
                                        </div>
                                        <i class="fas fa-credit-card fa-2x text-success"></i>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-sm btn-outline-primary">Configure</button>
                                        <button class="btn btn-sm btn-outline-secondary">Test</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card border-left-info h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title">PayPal</h6>
                                            <p class="card-text text-muted">Digital Payments</p>
                                            <span class="badge badge-success">Active</span>
                                        </div>
                                        <i class="fab fa-paypal fa-2x text-info"></i>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-sm btn-outline-primary">Configure</button>
                                        <button class="btn btn-sm btn-outline-secondary">Test</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card border-left-warning h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title">Bank Transfer</h6>
                                            <p class="card-text text-muted">Wire Transfer</p>
                                            <span class="badge badge-secondary">Inactive</span>
                                        </div>
                                        <i class="fas fa-university fa-2x text-warning"></i>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-sm btn-outline-primary">Configure</button>
                                        <button class="btn btn-sm btn-outline-success">Activate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Billing Settings -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Billing Settings</h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="companyName">Company Name</label>
                                    <input type="text" class="form-control" id="companyName" value="Multi-Tenant Platform Inc.">
                                </div>
                                <div class="form-group">
                                    <label for="companyAddress">Company Address</label>
                                    <textarea class="form-control" id="companyAddress" rows="3">123 Business Street, Suite 100, City, State 12345</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="taxId">Tax ID</label>
                                    <input type="text" class="form-control" id="taxId" value="12-3456789">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="currency">Default Currency</label>
                                    <select class="form-control" id="currency">
                                        <option value="USD" selected>USD - US Dollar</option>
                                        <option value="EUR">EUR - Euro</option>
                                        <option value="GBP">GBP - British Pound</option>
                                        <option value="CAD">CAD - Canadian Dollar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="taxRate">Default Tax Rate (%)</label>
                                    <input type="number" class="form-control" id="taxRate" value="8.5" step="0.1">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="autoInvoice" checked>
                                    <label class="form-check-label" for="autoInvoice">
                                        Auto-generate invoices
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="sendReminders" checked>
                                    <label class="form-check-label" for="sendReminders">
                                        Send payment reminders
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 