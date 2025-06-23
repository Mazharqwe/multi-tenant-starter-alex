<nav id="sidebar" class="bg-dark text-white vh-100 position-fixed" style="width: 250px; transition: all 0.3s;">
    <div class="p-3 border-bottom border-secondary">
        <h5 class="mb-0">
            <i class="bi bi-building me-2"></i>
            Tenant Portal
        </h5>
        @if(tenant())
            <small class="text-muted">{{ tenant('id') }}</small>
        @endif
    </div>
    
    <div class="mt-3">
        <a href="{{ route('dashboard') }}" class="btn w-100 text-start text-white border-0 py-3 px-3 nav-btn {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i>
            Dashboard
        </a>
        
        <a href="{{ route('users.index') }}" class="btn w-100 text-start text-white border-0 py-3 px-3 nav-btn {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <i class="bi bi-people me-2"></i>
            Users
        </a>
        
        <a href="{{ route('roles.index') }}" class="btn w-100 text-start text-white border-0 py-3 px-3 nav-btn {{ request()->routeIs('roles.*') ? 'active' : '' }}">
            <i class="bi bi-shield-check me-2"></i>
            Roles
        </a>
        
        <a href="{{ route('permissions.index') }}" class="btn w-100 text-start text-white border-0 py-3 px-3 nav-btn {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
            <i class="bi bi-key me-2"></i>
            Permissions
        </a>
        
        <a href="{{ route('appointments.index') }}" class="btn w-100 text-start text-white border-0 py-3 px-3 nav-btn {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-event me-2"></i>
            Appointments
        </a>
        
        <a href="{{ route('services.index') }}" class="btn w-100 text-start text-white border-0 py-3 px-3 nav-btn {{ request()->routeIs('services.*') ? 'active' : '' }}">
            <i class="bi bi-gear me-2"></i>
            Services
        </a>
        
        <a href="{{ route('staff.index') }}" class="btn w-100 text-start text-white border-0 py-3 px-3 nav-btn {{ request()->routeIs('staff.*') ? 'active' : '' }}">
            <i class="bi bi-person-badge me-2"></i>
            Staff
        </a>
    </div>
</nav> 