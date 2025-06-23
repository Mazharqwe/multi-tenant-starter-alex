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
                <form id="tenantCreateForm" method="POST" action="/super-admin/tenants" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Company Name *</label>
                            <input type="text" class="form-control" name="name" id="tenantName" required>
                            <div class="invalid-feedback" id="nameError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Subdomain *</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="subdomain" id="tenantSubdomain" required>
                                <span class="input-group-text">.yourapp.com</span>
                            </div>
                            <div class="invalid-feedback" id="subdomainError"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Admin Email *</label>
                            <input type="email" class="form-control" name="admin_email" id="adminEmail" required>
                            <div class="invalid-feedback" id="emailError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Admin Name *</label>
                            <input type="text" class="form-control" name="admin_name" id="adminName" required>
                            <div class="invalid-feedback" id="adminNameError"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="tel" class="form-control" name="phone" id="tenantPhone">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Country</label>
                            <select class="form-select" name="country" id="tenantCountry">
                                <option value="">Select Country</option>
                                <option value="US">United States</option>
                                <option value="UK">United Kingdom</option>
                                <option value="CA">Canada</option>
                                <option value="AU">Australia</option>
                                <option value="DE">Germany</option>
                                <option value="FR">France</option>
                                <option value="JP">Japan</option>
                                <option value="IN">India</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company Address</label>
                        <textarea class="form-control" name="address" id="tenantAddress" rows="3"></textarea>
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
                    <select class="form-select" name="plan" id="tenantPlan">
                        <option value="basic">Basic - $99/month</option>
                        <option value="pro">Pro - $499/month</option>
                        <option value="enterprise">Enterprise - $2499/month</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Trial Period</label>
                    <select class="form-select" name="trial_period" id="trialPeriod">
                        <option value="0">No Trial</option>
                        <option value="7">7 Days</option>
                        <option value="14">14 Days</option>
                        <option value="30">30 Days</option>
                    </select>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="sendWelcome" name="send_welcome" checked>
                        <label class="form-check-label" for="sendWelcome">
                            Send welcome email
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="autoActivate" name="auto_activate" checked>
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