@extends('layouts.super-admin')

@section('title', 'All Tenants')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Tenant Management</h4>
    <a href="{{ route('super-admin.tenants.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Tenant
    </a>
</div>

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0">All Tenants</h5>
            </div>
            <div class="col-md-6">
                <div class="d-flex gap-2">
                    <select class="form-select">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Inactive</option>
                        <option>Suspended</option>
                        <option>Trial</option>
                    </select>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search tenants...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tenant</th>
                        <th>Plan</th>
                        <th>Users</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Revenue</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tenants as $tenant)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="tenant-avatar bg-primary">{{ strtoupper(substr($tenant->name, 0, 2)) }}</div>
                                    <div>
                                        <div class="fw-semibold">{{ $tenant->name }}</div>
                                        <small class="text-muted">{{ $tenant->domains->first()->domain ?? 'No domain' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-success">Basic</span></td>
                            <td>{{ rand(5, 200) }}</td>
                            <td>{{ $tenant->created_at->format('M d, Y') }}</td>
                            <td>
                                <span class="status-badge {{ $tenant->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $tenant->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>$99/mo</td>
                            <td>
                                <a href="{{ route('super-admin.tenants.show', $tenant) }}" class="btn btn-sm btn-outline-primary btn-action">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('super-admin.tenants.edit', $tenant) }}" class="btn btn-sm btn-outline-secondary btn-action">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-outline-warning btn-action" onclick="toggleTenantStatus({{ $tenant->id }})">
                                    <i class="fas fa-pause"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger btn-action" onclick="deleteTenant({{ $tenant->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="fas fa-building fa-2x mb-3"></i>
                                <p>No tenants found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        @if($tenants->hasPages())
            <nav>
                <ul class="pagination justify-content-center mb-0">
                    @if($tenants->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $tenants->previousPageUrl() }}">Previous</a>
                        </li>
                    @endif

                    @foreach($tenants->getUrlRange(1, $tenants->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $tenants->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if($tenants->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $tenants->nextPageUrl() }}">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">Next</span>
                        </li>
                    @endif
                </ul>
            </nav>
        @endif
    </div>
</div>

<style>
    .table th {
        border-top: none;
        font-weight: 600;
        color: var(--primary-color);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table td {
        vertical-align: middle;
        padding: 1rem 0.75rem;
    }

    .tenant-avatar {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: white;
        margin-right: 0.75rem;
    }

    .status-badge {
        padding: 0.375rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-active { background: #d4edda; color: #155724; }
    .status-inactive { background: #f8d7da; color: #721c24; }
    .status-suspended { background: #fff3cd; color: #856404; }
    .status-trial { background: #cce5ff; color: #004085; }

    .btn-action {
        padding: 0.375rem 0.75rem;
        margin: 0 0.125rem;
        border-radius: 6px;
        font-size: 0.8rem;
    }
</style>
@endsection 