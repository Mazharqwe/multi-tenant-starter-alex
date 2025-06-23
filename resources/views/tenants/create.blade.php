@extends('layouts.super-admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h1 class="page-title">Create New Tenant</h1>
                <p class="page-subtitle">Set up a new tenant with their domain and configuration</p>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
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

    @if (session('success'))
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

    @if (session('error'))
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

    <div class="row">
        <!-- Main Form -->
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-building me-2"></i>Tenant Information
                    </h6>
                    <a href="{{ route('super-admin.tenants.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Back to Tenants
                    </a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('super-admin.tenants.store') }}" id="tenantCreateForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-building me-1"></i>Company Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" 
                                       placeholder="Enter company name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="subdomain" class="form-label">
                                    <i class="fas fa-globe me-1"></i>Subdomain <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('subdomain') is-invalid @enderror" 
                                           id="subdomain" name="subdomain" value="{{ old('subdomain') }}" 
                                           placeholder="tenant-name" required>
                                    <span class="input-group-text">.{{ request()->getHost() }}</span>
                                </div>
                                <small class="form-text text-muted">Enter the subdomain for this tenant (letters, numbers, hyphens only)</small>
                                <div id="fullDomainPreview" class="mt-2">
                                    <small class="text-info">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Full domain will be: <span id="previewText">tenant-name.{{ request()->getHost() }}</span>
                                    </small>
                                </div>
                                @error('subdomain')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="admin_email" class="form-label">
                                    <i class="fas fa-envelope me-1"></i>Admin Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control @error('admin_email') is-invalid @enderror" 
                                       id="admin_email" name="admin_email" value="{{ old('admin_email') }}" 
                                       placeholder="admin@company.com" required>
                                @error('admin_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="admin_name" class="form-label">
                                    <i class="fas fa-user me-1"></i>Admin Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('admin_name') is-invalid @enderror" 
                                       id="admin_name" name="admin_name" value="{{ old('admin_name') }}" 
                                       placeholder="John Doe" required>
                                @error('admin_name')
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
                                       id="phone" name="phone" value="{{ old('phone') }}" 
                                       placeholder="+1 (555) 123-4567">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="country" class="form-label">
                                    <i class="fas fa-flag me-1"></i>Country Code
                                </label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror" 
                                       id="country" name="country" value="{{ old('country') }}" 
                                       placeholder="US" maxlength="2">
                                <small class="form-text text-muted">Two-letter country code (e.g., US, CA, UK)</small>
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">
                                <i class="fas fa-map-marker-alt me-1"></i>Address
                            </label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="3" 
                                      placeholder="Enter company address">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="plan" class="form-label">
                                    <i class="fas fa-credit-card me-1"></i>Subscription Plan
                                </label>
                                <select class="form-select @error('plan') is-invalid @enderror" 
                                        id="plan" name="plan">
                                    <option value="">Select a plan</option>
                                    <option value="basic" {{ old('plan') == 'basic' ? 'selected' : '' }}>Basic - $99/month</option>
                                    <option value="pro" {{ old('plan') == 'pro' ? 'selected' : '' }}>Pro - $199/month</option>
                                    <option value="enterprise" {{ old('plan') == 'enterprise' ? 'selected' : '' }}>Enterprise - $499/month</option>
                                </select>
                                @error('plan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="trial_period" class="form-label">
                                    <i class="fas fa-calendar me-1"></i>Trial Period (Days)
                                </label>
                                <input type="number" class="form-control @error('trial_period') is-invalid @enderror" 
                                       id="trial_period" name="trial_period" value="{{ old('trial_period', 0) }}" 
                                       min="0" max="365" placeholder="0">
                                <small class="form-text text-muted">Number of trial days (0-365)</small>
                                @error('trial_period')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="auto_activate" 
                                           name="auto_activate" value="1" {{ old('auto_activate', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="auto_activate">
                                        <i class="fas fa-toggle-on me-1"></i>Auto-activate tenant
                                    </label>
                                </div>
                                <small class="form-text text-muted">Automatically activate the tenant upon creation</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="send_welcome" 
                                           name="send_welcome" value="1" {{ old('send_welcome', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="send_welcome">
                                        <i class="fas fa-envelope me-1"></i>Send welcome email
                                    </label>
                                </div>
                                <small class="form-text text-muted">Send welcome email to admin</small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <button type="button" class="btn btn-secondary" onclick="saveAsDraft()">
                                <i class="fas fa-save me-1"></i>Save as Draft
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Create Tenant
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Tips -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-lightbulb me-2"></i>Quick Tips
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Subdomain Rules</h6>
                                <p class="mb-0 text-muted small">Use only lowercase letters, numbers, and hyphens. Must be 3-63 characters long.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Database Setup</h6>
                                <p class="mb-0 text-muted small">A new database will be automatically created and migrated for this tenant.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Admin Access</h6>
                                <p class="mb-0 text-muted small">The admin will receive login credentials via email if welcome email is enabled.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Plan Features -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-list-check me-2"></i>Plan Features
                    </h6>
                </div>
                <div class="card-body">
                    <div id="planFeatures">
                        <p class="text-muted">Select a plan to see included features</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const planSelect = document.getElementById('plan');
    const planFeatures = document.getElementById('planFeatures');
    const subdomainInput = document.getElementById('subdomain');
    const previewText = document.getElementById('previewText');
    const currentDomain = '{{ request()->getHost() }}';
    
    const features = {
        'basic': [
            'Appointment Management',
            'Staff Management', 
            'Service Management',
            'Basic Analytics'
        ],
        'pro': [
            'Everything in Basic',
            'Advanced Analytics',
            'Custom Branding',
            'Priority Support'
        ],
        'enterprise': [
            'Everything in Pro',
            'API Access',
            'White Label Options',
            'Dedicated Support'
        ]
    };
    
    function updatePlanFeatures() {
        const selectedPlan = planSelect.value;
        if (selectedPlan && features[selectedPlan]) {
            const featureList = features[selectedPlan].map(feature => 
                `<div class="d-flex align-items-center mb-2">
                    <i class="fas fa-check text-success me-2"></i>
                    <span class="small">${feature}</span>
                </div>`
            ).join('');
            planFeatures.innerHTML = featureList;
        } else {
            planFeatures.innerHTML = '<p class="text-muted">Select a plan to see included features</p>';
        }
    }
    
    function updateDomainPreview() {
        const subdomain = subdomainInput.value || 'tenant-name';
        previewText.textContent = `${subdomain}.${currentDomain}`;
    }
    
    planSelect.addEventListener('change', updatePlanFeatures);
    subdomainInput.addEventListener('input', updateDomainPreview);
    
    updatePlanFeatures();
    updateDomainPreview();
});

function saveAsDraft() {
    const form = document.getElementById('tenantCreateForm');
    const formData = new FormData(form);
    formData.append('is_draft', '1');
    
    fetch('{{ route("super-admin.tenants.draft") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(Object.fromEntries(formData))
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Draft saved successfully!');
        } else {
            alert('Failed to save draft: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to save draft');
    });
}
</script>
@endsection 