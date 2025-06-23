<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Super Admin Dashboard') - Multi-Tenant Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/chart.js@4.0.0/dist/chart.min.css" rel="stylesheet">
    @stack('styles')
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --info-color: #17a2b8;
            --dark-color: #34495e;
            --sidebar-width: 280px;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(135deg, var(--primary-color), var(--dark-color));
            z-index: 1000;
            transition: all 0.3s;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar-brand i {
            margin-right: 0.75rem;
            background: var(--secondary-color);
            padding: 0.5rem;
            border-radius: 8px;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s;
            min-height: 100vh;
        }

        .nav-section {
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .nav-section-title {
            color: rgba(255,255,255,0.6);
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 0 1.5rem;
            margin-bottom: 0.5rem;
        }

        .nav-link {
            color: rgba(255,255,255,0.8) !important;
            padding: 0.75rem 1.5rem;
            border-radius: 0;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .nav-link:hover, .nav-link.active {
            background-color: rgba(255,255,255,0.1);
            color: white !important;
            border-left-color: var(--secondary-color);
        }

        .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
        }

        .topbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
            font-size: 0.9rem;
        }

        .content-area {
            padding: 2rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .sidebar.show {
                margin-left: 0;
            }
            
            .topbar {
                padding: 1rem;
            }
            
            .content-area {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    @include('super-admin.components.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        @include('super-admin.components.topbar')

        <!-- Content Area -->
        <div class="content-area">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
    <script>
        // Navigation Functions
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Show selected section
            const targetSection = document.getElementById(sectionId);
            if (targetSection) {
                targetSection.classList.add('active');
            }
            
            // Update active nav link
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            
            // Find and activate the correct nav link
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                if (link.getAttribute('onclick') && link.getAttribute('onclick').includes(sectionId)) {
                    link.classList.add('active');
                }
            });
            
            // Update page title and breadcrumb
            const titles = {
                'overview': 'Dashboard Overview',
                'analytics': 'Analytics Dashboard',
                'tenants': 'Tenant Management',
                'tenant-create': 'Add New Tenant',
                'subscriptions': 'Subscription Management',
                'users': 'System Users',
                'settings': 'System Settings',
                'logs': 'System Logs',
                'reports': 'Usage Reports',
                'billing': 'Billing Reports'
            };
            
            const pageTitle = document.getElementById('pageTitle');
            if (pageTitle && titles[sectionId]) {
                pageTitle.textContent = titles[sectionId];
            }
            
            // Update breadcrumb
            const breadcrumb = document.getElementById('breadcrumb');
            if (breadcrumb && titles[sectionId]) {
                breadcrumb.innerHTML = `
                    <li class="breadcrumb-item"><a href="{{ route('super-admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">${titles[sectionId]}</li>
                `;
            }
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            // Add to page
            document.body.appendChild(notification);
            
            // Auto-remove after 3 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 3000);
        }

        function formatNumber(num) {
            return new Intl.NumberFormat().format(num);
        }

        // Dashboard Stats Functions (keep these for real-time updates)
        function updateDashboardStats() {
            fetch('/super-admin/dashboard/stats')
                .then(response => response.json())
                .then(data => {
                    const totalTenantsEl = document.getElementById('totalTenants');
                    const activeTenantsEl = document.getElementById('activeTenants');
                    const monthlyRevenueEl = document.getElementById('monthlyRevenue');
                    const totalUsersEl = document.getElementById('totalUsers');
                    
                    if (totalTenantsEl) totalTenantsEl.textContent = formatNumber(data.total_tenants);
                    if (activeTenantsEl) activeTenantsEl.textContent = formatNumber(data.active_tenants);
                    if (monthlyRevenueEl) monthlyRevenueEl.textContent = '$' + formatNumber(data.monthly_revenue);
                    if (totalUsersEl) totalUsersEl.textContent = formatNumber(data.total_users);
                })
                .catch(error => console.error('Error updating stats:', error));
        }

        function updateRecentActivity() {
            fetch('/super-admin/dashboard/activity')
                .then(response => response.json())
                .then(data => {
                    const activityContainer = document.querySelector('.card-body');
                    if (data.length > 0 && activityContainer) {
                        let html = '';
                        data.forEach(activity => {
                            html += `
                                <div class="activity-item">
                                    <div class="activity-icon ${activity.color} text-white">
                                        <i class="${activity.icon}"></i>
                                    </div>
                                    <div class="activity-content">
                                        <p class="activity-title">${activity.title}</p>
                                        <p class="activity-desc">${activity.description}</p>
                                    </div>
                                    <div class="activity-time">${activity.time}</div>
                                </div>
                            `;
                        });
                        activityContainer.innerHTML = html;
                    }
                })
                .catch(error => console.error('Error updating activity:', error));
        }

        // Tenant Management Functions (using regular form submissions and redirects)
        function viewTenant(tenantId) {
            // Redirect to tenant view page
            window.location.href = `/super-admin/tenants/${tenantId}`;
        }

        function editTenant(tenantId) {
            // Redirect to tenant edit page
            window.location.href = `/super-admin/tenants/${tenantId}/edit`;
        }

        function toggleTenantStatus(tenantId) {
            if (confirm('Are you sure you want to toggle this tenant\'s status?')) {
                // Submit form to toggle status
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/super-admin/tenants/${tenantId}/toggle-status`;
                
                const csrfToken = document.querySelector('input[name="_token"]').value;
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                
                form.appendChild(csrfInput);
                document.body.appendChild(form);
                form.submit();
            }
        }

        function deleteTenant(tenantId) {
            if (confirm('Are you sure you want to delete this tenant? This action cannot be undone.')) {
                // Submit form to delete tenant
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/super-admin/tenants/${tenantId}`;
                
                const csrfToken = document.querySelector('input[name="_token"]').value;
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                
                form.appendChild(csrfInput);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit();
            }
        }

        function refreshDashboard() {
            const refreshBtn = document.querySelector('button[onclick="refreshDashboard()"]');
            if (refreshBtn) {
                const icon = refreshBtn.querySelector('i');
                
                // Add spinning animation
                icon.classList.add('fa-spin');
                refreshBtn.disabled = true;
                
                // Update all dashboard data
                Promise.all([
                    updateDashboardStats(),
                    updateRecentActivity()
                ]).finally(() => {
                    // Remove spinning animation
                    icon.classList.remove('fa-spin');
                    refreshBtn.disabled = false;
                    
                    // Show success message
                    showNotification('Dashboard refreshed successfully!', 'success');
                });
            }
        }

        // Tenant Creation Functions (using regular form submission)
        function createTenant() {
            // Validate form
            if (!validateTenantForm()) {
                return;
            }

            // Submit the form normally
            const form = document.getElementById('tenantCreateForm');
            if (form) {
                form.submit();
            }
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

        // Update activity every 60 seconds
        setInterval(function() {
            updateRecentActivity();
        }, 60000);

        // Coming Soon Function
        function showComingSoon(featureName) {
            showNotification(`${featureName} feature is coming soon!`, 'info');
        }
    </script>
</body>
</html> 