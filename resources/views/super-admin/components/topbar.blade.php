<div class="topbar">
    <div class="d-flex align-items-center">
        <button class="btn btn-outline-secondary me-3 d-md-none" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <div>
            <h1 class="page-title" id="pageTitle">
                @if(request()->routeIs('super-admin.dashboard'))
                    Dashboard Overview
                @elseif(request()->routeIs('super-admin.tenants.index'))
                    All Tenants
                @elseif(request()->routeIs('super-admin.tenants.create'))
                    Add New Tenant
                @elseif(request()->routeIs('super-admin.tenants.show'))
                    Tenant Details
                @elseif(request()->routeIs('super-admin.tenants.edit'))
                    Edit Tenant
                @else
                    Super Admin
                @endif
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" id="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('super-admin.dashboard') }}">Home</a></li>
                    @if(request()->routeIs('super-admin.tenants.*'))
                        <li class="breadcrumb-item"><a href="{{ route('super-admin.tenants.index') }}">Tenants</a></li>
                        @if(request()->routeIs('super-admin.tenants.create'))
                            <li class="breadcrumb-item active">Add New</li>
                        @elseif(request()->routeIs('super-admin.tenants.show'))
                            <li class="breadcrumb-item active">Details</li>
                        @elseif(request()->routeIs('super-admin.tenants.edit'))
                            <li class="breadcrumb-item active">Edit</li>
                        @else
                            <li class="breadcrumb-item active">All Tenants</li>
                        @endif
                    @else
                        <li class="breadcrumb-item active">Dashboard</li>
                    @endif
                </ol>
            </nav>
        </div>
    </div>
    <div class="d-flex align-items-center">
        <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="fas fa-user-shield me-2"></i>
                Super Admin
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
            </ul>
        </div>
        @if(request()->routeIs('super-admin.dashboard'))
            <button class="btn btn-outline-primary ms-3" onclick="refreshDashboard()" title="Refresh Dashboard">
                <i class="fas fa-sync-alt"></i>
            </button>
        @endif
    </div>
</div> 