@props(['tenant'])

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
        <button class="btn btn-sm btn-outline-primary btn-action" onclick="viewTenant({{ $tenant->id }})">
            <i class="fas fa-eye"></i>
        </button>
        <button class="btn btn-sm btn-outline-secondary btn-action" onclick="editTenant({{ $tenant->id }})">
            <i class="fas fa-edit"></i>
        </button>
        <button class="btn btn-sm btn-outline-warning btn-action" onclick="toggleTenantStatus({{ $tenant->id }})">
            <i class="fas fa-pause"></i>
        </button>
        <button class="btn btn-sm btn-outline-danger btn-action" onclick="deleteTenant({{ $tenant->id }})">
            <i class="fas fa-trash"></i>
        </button>
    </td>
</tr>

<style>
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