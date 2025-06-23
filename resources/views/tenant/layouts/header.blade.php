<header class="bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
        <button class="btn btn-outline-secondary me-3 d-lg-none" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>
        <h4 class="mb-0" id="pageTitle">@yield('page-title', 'Dashboard')</h4>
    </div>

    <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center" 
                type="button" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle me-2"></i>
            {{ Auth::user()->name ?? 'User' }}
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
            <li><a class="dropdown-item" href="{{ route('settings') }}"><i class="bi bi-gear me-2"></i>Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</header> 