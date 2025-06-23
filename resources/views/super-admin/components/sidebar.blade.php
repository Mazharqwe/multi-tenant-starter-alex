<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('super-admin.dashboard') }}" class="sidebar-brand">
            <i class="fas fa-crown"></i>
            Super Admin
        </a>
    </div>
    
    <div class="nav-section">
        <div class="nav-section-title">Dashboard</div>
        <a class="nav-link {{ request()->routeIs('super-admin.dashboard') ? 'active' : '' }}" href="{{ route('super-admin.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i>
            Overview
        </a>
        <a class="nav-link {{ request()->routeIs('super-admin.analytics') ? 'active' : '' }}" href="{{ route('super-admin.analytics') }}">
            <i class="fas fa-chart-line"></i>
            Analytics
        </a>
    </div>

    <div class="nav-section">
        <div class="nav-section-title">Tenant Management</div>
        <a class="nav-link {{ request()->routeIs('super-admin.tenants.*') ? 'active' : '' }}" href="{{ route('super-admin.tenants.index') }}">
            <i class="fas fa-building"></i>
            All Tenants
        </a>
        <a class="nav-link {{ request()->routeIs('super-admin.tenants.create') ? 'active' : '' }}" href="{{ route('super-admin.tenants.create') }}">
            <i class="fas fa-plus-circle"></i>
            Add Tenant
        </a>
        <a class="nav-link {{ request()->routeIs('super-admin.subscriptions') ? 'active' : '' }}" href="{{ route('super-admin.subscriptions') }}">
            <i class="fas fa-credit-card"></i>
            Subscriptions
        </a>
    </div>

    <div class="nav-section">
        <div class="nav-section-title">System</div>
        <a class="nav-link {{ request()->routeIs('super-admin.users') ? 'active' : '' }}" href="{{ route('super-admin.users') }}">
            <i class="fas fa-users"></i>
            System Users
        </a>
        <a class="nav-link {{ request()->routeIs('super-admin.settings') ? 'active' : '' }}" href="{{ route('super-admin.settings') }}">
            <i class="fas fa-cogs"></i>
            System Settings
        </a>
        <a class="nav-link {{ request()->routeIs('super-admin.logs') ? 'active' : '' }}" href="{{ route('super-admin.logs') }}">
            <i class="fas fa-file-alt"></i>
            System Logs
        </a>
    </div>

    <div class="nav-section">
        <div class="nav-section-title">Reports</div>
        <a class="nav-link {{ request()->routeIs('super-admin.reports') ? 'active' : '' }}" href="{{ route('super-admin.reports') }}">
            <i class="fas fa-chart-bar"></i>
            Usage Reports
        </a>
        <a class="nav-link {{ request()->routeIs('super-admin.billing') ? 'active' : '' }}" href="{{ route('super-admin.billing') }}">
            <i class="fas fa-dollar-sign"></i>
            Billing Reports
        </a>
    </div>
</nav> 