@extends('layouts.super-admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h1 class="page-title">System Settings</h1>
                <p class="page-subtitle">Configure system-wide settings and preferences</p>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- General Settings -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">General Settings</h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="siteName">Site Name</label>
                            <input type="text" class="form-control" id="siteName" value="Multi-Tenant Platform">
                        </div>
                        <div class="form-group">
                            <label for="siteDescription">Site Description</label>
                            <textarea class="form-control" id="siteDescription" rows="3">Professional multi-tenant platform for businesses</textarea>
                        </div>
                        <div class="form-group">
                            <label for="timezone">Default Timezone</label>
                            <select class="form-control" id="timezone">
                                <option value="UTC">UTC</option>
                                <option value="America/New_York">Eastern Time</option>
                                <option value="America/Chicago">Central Time</option>
                                <option value="America/Denver">Mountain Time</option>
                                <option value="America/Los_Angeles">Pacific Time</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dateFormat">Date Format</label>
                            <select class="form-control" id="dateFormat">
                                <option value="Y-m-d">YYYY-MM-DD</option>
                                <option value="m/d/Y">MM/DD/YYYY</option>
                                <option value="d/m/Y">DD/MM/YYYY</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Email Settings -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Email Settings</h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="smtpHost">SMTP Host</label>
                            <input type="text" class="form-control" id="smtpHost" value="smtp.gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="smtpPort">SMTP Port</label>
                            <input type="number" class="form-control" id="smtpPort" value="587">
                        </div>
                        <div class="form-group">
                            <label for="smtpUsername">SMTP Username</label>
                            <input type="email" class="form-control" id="smtpUsername" value="noreply@example.com">
                        </div>
                        <div class="form-group">
                            <label for="smtpPassword">SMTP Password</label>
                            <input type="password" class="form-control" id="smtpPassword" value="••••••••">
                        </div>
                        <div class="form-group">
                            <label for="fromEmail">From Email</label>
                            <input type="email" class="form-control" id="fromEmail" value="noreply@example.com">
                        </div>
                        <div class="form-group">
                            <label for="fromName">From Name</label>
                            <input type="text" class="form-control" id="fromName" value="Multi-Tenant Platform">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Security Settings</h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="sessionTimeout">Session Timeout (minutes)</label>
                            <input type="number" class="form-control" id="sessionTimeout" value="120">
                        </div>
                        <div class="form-group">
                            <label for="maxLoginAttempts">Maximum Login Attempts</label>
                            <input type="number" class="form-control" id="maxLoginAttempts" value="5">
                        </div>
                        <div class="form-group">
                            <label for="lockoutDuration">Lockout Duration (minutes)</label>
                            <input type="number" class="form-control" id="lockoutDuration" value="15">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="requireTwoFactor" checked>
                            <label class="form-check-label" for="requireTwoFactor">
                                Require Two-Factor Authentication for Super Admins
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="enableAuditLog" checked>
                            <label class="form-check-label" for="enableAuditLog">
                                Enable Audit Logging
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="forceSSL">
                            <label class="form-check-label" for="forceSSL">
                                Force SSL/HTTPS
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tenant Settings -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tenant Settings</h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="defaultPlan">Default Subscription Plan</label>
                            <select class="form-control" id="defaultPlan">
                                <option value="basic">Basic</option>
                                <option value="pro">Pro</option>
                                <option value="enterprise">Enterprise</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="trialDays">Trial Period (days)</label>
                            <input type="number" class="form-control" id="trialDays" value="14">
                        </div>
                        <div class="form-group">
                            <label for="maxUsersPerTenant">Maximum Users per Tenant</label>
                            <input type="number" class="form-control" id="maxUsersPerTenant" value="100">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="autoApproveTenants" checked>
                            <label class="form-check-label" for="autoApproveTenants">
                                Auto-approve new tenants
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="allowCustomDomains" checked>
                            <label class="form-check-label" for="allowCustomDomains">
                                Allow custom domains
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="enableBackup">
                            <label class="form-check-label" for="enableBackup">
                                Enable automatic backups
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 