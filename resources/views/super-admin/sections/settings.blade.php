<h4 class="mb-4">System Settings</h4>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">General Settings</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Application Name</label>
                        <input type="text" class="form-control" value="Multi-Tenant SaaS">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Default Domain</label>
                        <input type="text" class="form-control" value="yourapp.com">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Support Email</label>
                        <input type="email" class="form-control" value="support@yourapp.com">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Default Timezone</label>
                        <select class="form-select">
                            <option>UTC</option>
                            <option>America/New_York</option>
                            <option>Europe/London</option>
                            <option>Asia/Tokyo</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Security Settings</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="requireMFA" checked>
                            <label class="form-check-label" for="requireMFA">
                                Require MFA for admins
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="enableSSO">
                            <label class="form-check-label" for="enableSSO">
                                Enable SSO integration
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Session Timeout (minutes)</label>
                        <input type="number" class="form-control" value="60">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password Policy</label>
                        <select class="form-select">
                            <option>Standard</option>
                            <option>Strong</option>
                            <option>Enterprise</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">System Status</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span>Database</span>
                    <span class="badge bg-success">Online</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span>Redis Cache</span>
                    <span class="badge bg-success">Online</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span>Email Service</span>
                    <span class="badge bg-success">Online</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span>File Storage</span>
                    <span class="badge bg-warning">Warning</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span>Payment Gateway</span>
                    <span class="badge bg-success">Online</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Actions</h5>
            </div>
            <div class="card-body">
                <button class="btn btn-primary w-100 mb-2">
                    <i class="fas fa-save me-2"></i>Save Settings
                </button>
                <button class="btn btn-outline-warning w-100 mb-2">
                    <i class="fas fa-sync me-2"></i>Clear Cache
                </button>
                <button class="btn btn-outline-info w-100">
                    <i class="fas fa-download me-2"></i>Backup System
                </button>
            </div>
        </div>
    </div>
</div> 