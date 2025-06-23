@extends('layouts.super-admin')

@section('title', 'Add New Tenant')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Add New Tenant</h4>
    <a href="{{ route('super-admin.tenants.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Tenants
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Tenant Information</h5>
            </div>
            <div class="card-body">
                <form id="tenantCreateForm" method="POST" action="{{ route('super-admin.tenants.store') }}" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Company Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="tenantName" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Subdomain *</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('subdomain') is-invalid @enderror" name="subdomain" id="tenantSubdomain" value="{{ old('subdomain') }}" required>
                                <span class="input-group-text">.yourapp.com</span>
                            </div>
                            @error('subdomain')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Admin Email *</label>
                            <input type="email" class="form-control @error('admin_email') is-invalid @enderror" name="admin_email" id="adminEmail" value="{{ old('admin_email') }}" required>
                            @error('admin_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Admin Name *</label>
                            <input type="text" class="form-control @error('admin_name') is-invalid @enderror" name="admin_name" id="adminName" value="{{ old('admin_name') }}" required>
                            @error('admin_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="tenantPhone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Country</label>
                            <select class="form-select @error('country') is-invalid @enderror" name="country" id="tenantCountry">
                                <option value="">Select Country</option>
                                <option value="US" {{ old('country') == 'US' ? 'selected' : '' }}>United States</option>
                                <option value="UK" {{ old('country') == 'UK' ? 'selected' : '' }}>United Kingdom</option>
                                <option value="CA" {{ old('country') == 'CA' ? 'selected' : '' }}>Canada</option>
                                <option value="AU" {{ old('country') == 'AU' ? 'selected' : '' }}>Australia</option>
                                <option value="DE" {{ old('country') == 'DE' ? 'selected' : '' }}>Germany</option>
                                <option value="FR" {{ old('country') == 'FR' ? 'selected' : '' }}>France</option>
                                <option value="JP" {{ old('country') == 'JP' ? 'selected' : '' }}>Japan</option>
                                <option value="IN" {{ old('country') == 'IN' ? 'selected' : '' }}>India</option>
                            </select>
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="tenantAddress" rows="3">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Subscription Plan</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Select Plan</label>
                    <select class="form-select @error('plan') is-invalid @enderror" name="plan" id="tenantPlan">
                        <option value="basic" {{ old('plan') == 'basic' ? 'selected' : '' }}>Basic - $99/month</option>
                        <option value="pro" {{ old('plan') == 'pro' ? 'selected' : '' }}>Pro - $499/month</option>
                        <option value="enterprise" {{ old('plan') == 'enterprise' ? 'selected' : '' }}>Enterprise - $2499/month</option>
                    </select>
                    @error('plan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Trial Period</label>
                    <select class="form-select @error('trial_period') is-invalid @enderror" name="trial_period" id="trialPeriod">
                        <option value="0" {{ old('trial_period') == '0' ? 'selected' : '' }}>No Trial</option>
                        <option value="7" {{ old('trial_period') == '7' ? 'selected' : '' }}>7 Days</option>
                        <option value="14" {{ old('trial_period') == '14' ? 'selected' : '' }}>14 Days</option>
                        <option value="30" {{ old('trial_period') == '30' ? 'selected' : '' }}>30 Days</option>
                    </select>
                    @error('trial_period')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="sendWelcome" name="send_welcome" value="1" {{ old('send_welcome') ? 'checked' : '' }}>
                        <label class="form-check-label" for="sendWelcome">
                            Send welcome email
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="autoActivate" name="auto_activate" value="1" {{ old('auto_activate') ? 'checked' : '' }}>
                        <label class="form-check-label" for="autoActivate">
                            Auto-activate tenant
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Actions</h5>
            </div>
            <div class="card-body">
                <button class="btn btn-primary w-100 mb-2" id="createTenantBtn" onclick="createTenant()">
                    <i class="fas fa-plus me-2"></i>Create Tenant
                </button>
                <button class="btn btn-outline-secondary w-100" onclick="saveAsDraft()">
                    <i class="fas fa-save me-2"></i>Save as Draft
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">
                    <i class="fas fa-check-circle me-2"></i>Tenant Created Successfully!
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                </div>
                <h6 class="text-center mb-3" id="successMessage"></h6>
                <p class="text-center text-muted" id="successSubmessage"></p>
                <div class="alert alert-info" id="tenantInfo" style="display: none;">
                    <h6><i class="fas fa-info-circle me-2"></i>Tenant Details:</h6>
                    <div id="tenantDetails"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" class="btn btn-primary" id="viewTenantBtn" style="display: none;">
                    <i class="fas fa-eye me-2"></i>View Tenant
                </a>
                <a href="#" class="btn btn-success" id="visitTenantBtn" style="display: none;">
                    <i class="fas fa-external-link-alt me-2"></i>Visit Tenant Site
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function createTenant() {
    // Validate form
    if (!validateTenantForm()) {
        return;
    }

    // Show loading state
    const btn = document.getElementById('createTenantBtn');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating Tenant...';
    btn.disabled = true;

    // Get form data
    const form = document.getElementById('tenantCreateForm');
    const formData = new FormData(form);

    // Submit via AJAX
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success modal
            document.getElementById('successMessage').textContent = data.message;
            document.getElementById('successSubmessage').textContent = data.submessage;
            
            // Show tenant details if available
            if (data.tenant) {
                const tenantInfo = document.getElementById('tenantInfo');
                const tenantDetails = document.getElementById('tenantDetails');
                const viewTenantBtn = document.getElementById('viewTenantBtn');
                const visitTenantBtn = document.getElementById('visitTenantBtn');
                
                tenantDetails.innerHTML = `
                    <strong>Name:</strong> ${data.tenant.name}<br>
                    <strong>Domain:</strong> ${data.tenant.domains[0]?.domain || 'N/A'}<br>
                    <strong>Admin Email:</strong> ${data.tenant.admin_email || data.tenant.data?.admin_email || 'N/A'}<br>
                    <strong>Status:</strong> <span class="badge ${data.tenant.is_active ? 'bg-success' : 'bg-warning'}">${data.tenant.is_active ? 'Active' : 'Inactive'}</span>
                `;
                
                tenantInfo.style.display = 'block';
                
                // Set up action buttons
                if (data.redirect_url) {
                    viewTenantBtn.href = data.redirect_url;
                    viewTenantBtn.style.display = 'inline-block';
                }
                
                if (data.tenant_url) {
                    visitTenantBtn.href = data.tenant_url;
                    visitTenantBtn.target = '_blank';
                    visitTenantBtn.style.display = 'inline-block';
                }
            }
            
            // Show the modal
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
            
            // Reset form
            form.reset();
            
        } else {
            // Show error message
            showAlert('Error: ' + data.message, 'danger');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('An error occurred while creating the tenant. Please try again.', 'danger');
    })
    .finally(() => {
        // Reset button state
        btn.innerHTML = originalText;
        btn.disabled = false;
    });
}

function showAlert(message, type) {
    // Create alert element
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        <i class="fas fa-${type === 'danger' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    // Insert at the top of the form
    const form = document.getElementById('tenantCreateForm');
    form.parentNode.insertBefore(alertDiv, form);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 5000);
}

function validateTenantForm() {
    let isValid = true;
    
    // Clear previous errors
    clearValidationErrors();
    
    // Validate required fields
    const requiredFields = [
        { id: 'tenantName', name: 'Company Name' },
        { id: 'tenantSubdomain', name: 'Subdomain' },
        { id: 'adminEmail', name: 'Admin Email' },
        { id: 'adminName', name: 'Admin Name' }
    ];
    
    requiredFields.forEach(field => {
        const element = document.getElementById(field.id);
        if (!element.value.trim()) {
            showFieldError(field.id, `${field.name} is required`);
            isValid = false;
        }
    });
    
    // Validate email format
    const email = document.getElementById('adminEmail').value;
    if (email && !isValidEmail(email)) {
        showFieldError('adminEmail', 'Please enter a valid email address');
        isValid = false;
    }
    
    // Validate subdomain format
    const subdomain = document.getElementById('tenantSubdomain').value;
    if (subdomain && !isValidSubdomain(subdomain)) {
        showFieldError('tenantSubdomain', 'Subdomain can only contain letters, numbers, and hyphens');
        isValid = false;
    }
    
    return isValid;
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidSubdomain(subdomain) {
    const subdomainRegex = /^[a-z0-9-]+$/;
    return subdomainRegex.test(subdomain) && subdomain.length >= 3;
}

function showFieldError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.getElementById(fieldId.replace('tenant', '').toLowerCase() + 'Error') || 
                   document.getElementById(fieldId + 'Error');
    
    if (field && errorDiv) {
        field.classList.add('is-invalid');
        errorDiv.textContent = message;
    }
}

function clearValidationErrors() {
    document.querySelectorAll('.is-invalid').forEach(field => {
        field.classList.remove('is-invalid');
    });
    
    document.querySelectorAll('.invalid-feedback').forEach(error => {
        error.textContent = '';
    });
}

function saveAsDraft() {
    // Add draft flag to form and submit
    const form = document.getElementById('tenantCreateForm');
    if (form) {
        const draftInput = document.createElement('input');
        draftInput.type = 'hidden';
        draftInput.name = 'is_draft';
        draftInput.value = '1';
        form.appendChild(draftInput);
        form.submit();
    }
}

// Real-time validation
document.addEventListener('DOMContentLoaded', function() {
    // Subdomain validation
    const subdomainField = document.getElementById('tenantSubdomain');
    if (subdomainField) {
        subdomainField.addEventListener('input', function() {
            const value = this.value.toLowerCase();
            this.value = value.replace(/[^a-z0-9-]/g, '');
            
            if (value && !isValidSubdomain(value)) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    }

    // Email validation
    const emailField = document.getElementById('adminEmail');
    if (emailField) {
        emailField.addEventListener('blur', function() {
            if (this.value && !isValidEmail(this.value)) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    }

    // Auto-generate subdomain from company name
    const nameField = document.getElementById('tenantName');
    const subdomainField = document.getElementById('tenantSubdomain');
    if (nameField && subdomainField) {
        nameField.addEventListener('input', function() {
            if (!subdomainField.value) {
                const subdomain = this.value.toLowerCase()
                    .replace(/[^a-z0-9]/g, '')
                    .substring(0, 20);
                subdomainField.value = subdomain;
            }
        });
    }
});
</script>
@endsection 