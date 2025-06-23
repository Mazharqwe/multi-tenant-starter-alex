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
                        <h1 class="page-title">Edit Tenant</h1>
                        <p class="page-subtitle">{{ $tenant->name }} • ID: {{ $tenant->id }}</p>
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

    @if ($errors->any())
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>There were some errors with your submission:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <!-- Main Form -->
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-edit me-2"></i>Edit Tenant Information
                    </h6>
                    <div class="d-flex gap-2">
                        <a href="{{ route('super-admin.tenants.show', $tenant) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye me-1"></i>View Tenant
                        </a>
                        <a href="{{ route('super-admin.tenants.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Back to Tenants
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('super-admin.tenants.update', $tenant) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-building me-1"></i>Company Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $tenant->name) }}" 
                                       placeholder="Enter company name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-1"></i>Email Address <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $tenant->admin_email) }}" 
                                       placeholder="admin@company.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">
                                    <i class="fas fa-phone me-1"></i>Phone Number
                                </label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone', $tenant->admin_phone) }}" 
                                       placeholder="+1 (555) 123-4567">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">
                                    <i class="fas fa-toggle-on me-1"></i>Status
                                </label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" name="is_active">
                                    <option value="1" {{ $tenant->is_active ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$tenant->is_active ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="address" class="form-label">
                                    <i class="fas fa-map-marker-alt me-1"></i>Address
                                </label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" name="address" rows="3" 
                                          placeholder="Enter company address">{{ old('address', $tenant->admin_address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="plan" class="form-label">
                                    <i class="fas fa-credit-card me-1"></i>Subscription Plan
                                </label>
                                <select class="form-select @error('plan') is-invalid @enderror" 
                                        id="plan" name="plan">
                                    <option value="">Select a plan</option>
                                    <option value="basic" {{ old('plan', $tenant->data['subscription_plan'] ?? '') == 'basic' ? 'selected' : '' }}>Basic - $99/month</option>
                                    <option value="pro" {{ old('plan', $tenant->data['subscription_plan'] ?? '') == 'pro' ? 'selected' : '' }}>Pro - $199/month</option>
                                    <option value="enterprise" {{ old('plan', $tenant->data['subscription_plan'] ?? '') == 'enterprise' ? 'selected' : '' }}>Enterprise - $499/month</option>
                                </select>
                                @error('plan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="trial_period" class="form-label">
                                    <i class="fas fa-clock me-1"></i>Trial Period (days)
                                </label>
                                <input type="number" class="form-control @error('trial_period') is-invalid @enderror" 
                                       id="trial_period" name="trial_period" 
                                       value="{{ old('trial_period', $tenant->data['trial_period'] ?? 14) }}" 
                                       min="0" max="365">
                                @error('trial_period')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('super-admin.tenants.show', $tenant) }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Update Tenant
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Current Information -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle me-2"></i>Current Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-circle text-{{ $tenant->is_active ? 'success' : 'danger' }}"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <small class="text-muted">Status</small>
                                <div>
                                    <span class="badge {{ $tenant->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $tenant->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-calendar text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <small class="text-muted">Created</small>
                                <div>{{ $tenant->created_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-clock text-info"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <small class="text-muted">Last Updated</small>
                                <div>{{ $tenant->updated_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                    </div>
                    @if($tenant->domains->count() > 0)
                        <div class="mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-globe text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <small class="text-muted">Domain</small>
                                    <div>
                                        <a href="http://{{ $tenant->domains->first()->domain }}" target="_blank" class="text-decoration-none">
                                            {{ $tenant->domains->first()->domain }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if($tenant->is_active)
                            <button type="button" class="btn btn-warning btn-sm" onclick="suspendTenant({{ $tenant->id }})">
                                <i class="fas fa-pause me-1"></i>Suspend Tenant
                            </button>
                        @else
                            <button type="button" class="btn btn-success btn-sm" onclick="activateTenant({{ $tenant->id }})">
                                <i class="fas fa-play me-1"></i>Activate Tenant
                            </button>
                        @endif
                        <button type="button" class="btn btn-info btn-sm" onclick="resetPassword({{ $tenant->id }})">
                            <i class="fas fa-key me-1"></i>Reset Admin Password
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="sendWelcomeEmail({{ $tenant->id }})">
                            <i class="fas fa-envelope me-1"></i>Send Welcome Email
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteTenant({{ $tenant->id }})">
                            <i class="fas fa-trash me-1"></i>Delete Tenant
                        </button>
                    </div>
                </div>
            </div>

            <!-- Recent Changes -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-history me-2"></i>Recent Changes
                    </h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            <div>
                                <small class="text-muted">Status updated</small>
                                <div>Changed to Active</div>
                            </div>
                            <small class="text-muted">2 days ago</small>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            <div>
                                <small class="text-muted">Email updated</small>
                                <div>admin@company.com</div>
                            </div>
                            <small class="text-muted">1 week ago</small>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            <div>
                                <small class="text-muted">Tenant created</small>
                                <div>Initial setup</div>
                            </div>
                            <small class="text-muted">{{ $tenant->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function suspendTenant(tenantId) {
    if (confirm('Are you sure you want to suspend this tenant? They will not be able to access their account.')) {
        // Add suspension logic here
        alert('Tenant suspended successfully!');
    }
}

function activateTenant(tenantId) {
    if (confirm('Are you sure you want to activate this tenant?')) {
        // Add activation logic here
        alert('Tenant activated successfully!');
    }
}

function resetPassword(tenantId) {
    if (confirm('Are you sure you want to reset the admin password for this tenant?')) {
        // Add password reset logic here
        alert('Password reset email sent!');
    }
}

function sendWelcomeEmail(tenantId) {
    if (confirm('Send welcome email to the tenant admin?')) {
        // Add welcome email logic here
        alert('Welcome email sent!');
    }
}

function deleteTenant(tenantId) {
    if (confirm('Are you sure you want to delete this tenant? This action cannot be undone and will permanently remove all tenant data.')) {
        // Add deletion logic here
        alert('Tenant deleted successfully!');
    }
}
</script>
@endsection 