@extends('tenant.layouts.app')

@section('title', 'Roles Management')
@section('page-title', 'Roles Management')

@push('styles')
<style>
.loading {
    display: inline-block;
    width: 16px;
    height: 16px;
    border: 2px solid #f3f3f3;
    border-top: 2px solid #007bff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
.fade-in { animation: fadeIn 0.3s ease-in; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
.fade-out { animation: fadeOut 0.3s ease-out; }
@keyframes fadeOut { from { opacity: 1; transform: translateY(0); } to { opacity: 0; transform: translateY(-10px); } }
</style>
@endpush

@section('content')
<div class="page-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Roles Management</h2>
        <button class="btn btn-primary" onclick="openRoleModal()">
            <i class="bi bi-plus-circle me-2"></i>
            Add Role
        </button>
    </div>
    <div id="alertContainer"></div>
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">All Roles</h5>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search roles..." id="roleSearch" onkeyup="searchRoles()">
                        <button class="btn btn-outline-secondary" onclick="searchRoles()">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="rolesTableBody">
                        @forelse($roles as $role)
                        <tr data-role-id="{{ $role->id }}">
                            <td><span class="fw-bold">{{ $role->name }}</span></td>
                            <td>{{ $role->description }}</td>
                            <td><span class="badge bg-info">{{ $role->permissions_count }}</span></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary" onclick="editRole({{ $role->id }})" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-outline-danger" onclick="deleteRole({{ $role->id }})" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                <i class="bi bi-shield-lock display-4 d-block mb-3"></i>
                                <h5>No Roles Found</h5>
                                <p>Get started by adding your first role.</p>
                                <button class="btn btn-primary" onclick="openRoleModal()">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    Add Role
                                </button>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($roles->hasPages())
        <div class="card-footer">
            {{ $roles->links() }}
        </div>
        @endif
    </div>
</div>
@include('tenant.components.role-modal')
@endsection

@push('scripts')
<script>
let currentRoleId = null;
function openRoleModal(roleId = null) {
    currentRoleId = roleId;
    const modal = document.getElementById('roleModal');
    if (!modal) return alert('Modal not found!');
    const bsModal = new bootstrap.Modal(modal);
    const title = modal.querySelector('#roleModalTitle');
    const form = modal.querySelector('#roleForm');
    form.reset();
    modal.querySelector('#roleId').value = '';
    form.querySelectorAll('.is-valid, .is-invalid').forEach(input => input.classList.remove('is-valid', 'is-invalid'));
    if (roleId) {
        title.textContent = 'Edit Role';
        loadRoleData(roleId);
    } else {
        title.textContent = 'Add New Role';
    }
    bsModal.show();
}
function loadRoleData(roleId) {
    fetch(`/roles/${roleId}/edit`, {
        method: 'GET',
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const role = data.role;
            document.getElementById('roleId').value = role.id;
            document.getElementById('roleName').value = role.name;
            document.getElementById('roleDescription').value = role.description || '';
        }
    });
}
function saveRole() {
    if (!validateRoleForm()) {
        showRoleAlert('Please fill in all required fields', 'warning');
        return;
    }
    const formData = {
        id: document.getElementById('roleId').value,
        name: document.getElementById('roleName').value,
        description: document.getElementById('roleDescription').value
    };
    const url = formData.id ? `/roles/${formData.id}` : '/roles';
    const method = formData.id ? 'PUT' : 'POST';
    const saveBtn = document.querySelector('#roleModal .btn-primary');
    const originalText = saveBtn.innerHTML;
    saveBtn.innerHTML = '<span class="loading"></span> Saving...';
    saveBtn.disabled = true;
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        },
        body: JSON.stringify(formData)
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const modal = document.getElementById('roleModal');
            const bsModal = bootstrap.Modal.getInstance(modal);
            bsModal.hide();
            showRoleAlert(data.message, 'success');
            if (formData.id) updateRoleRow(data.role); else addRoleRow(data.role);
            form.reset();
            form.querySelectorAll('.is-valid, .is-invalid').forEach(input => input.classList.remove('is-valid', 'is-invalid'));
        } else {
            showRoleAlert('Error: ' + data.message, 'danger');
        }
    })
    .catch(() => showRoleAlert('An error occurred while saving the role', 'danger'))
    .finally(() => { saveBtn.innerHTML = originalText; saveBtn.disabled = false; });
}
function updateRoleRow(role) {
    const row = document.querySelector(`tr[data-role-id="${role.id}"]`);
    if (row) {
        row.querySelector('td:nth-child(1) .fw-bold').textContent = role.name;
        row.querySelector('td:nth-child(2)').textContent = role.description || '';
        row.querySelector('td:nth-child(3) .badge').textContent = role.permissions_count;
    }
}
function addRoleRow(role) {
    const newRow = `<tr data-role-id="${role.id}" class="fade-in">
        <td><span class="fw-bold">${role.name}</span></td>
        <td>${role.description || ''}</td>
        <td><span class="badge bg-info">${role.permissions_count || 0}</span></td>
        <td>
            <div class="btn-group btn-group-sm">
                <button class="btn btn-outline-primary" onclick="editRole(${role.id})" title="Edit"><i class="bi bi-pencil"></i></button>
                <button class="btn btn-outline-danger" onclick="deleteRole(${role.id})" title="Delete"><i class="bi bi-trash"></i></button>
            </div>
        </td>
    </tr>`;
    const tbody = document.getElementById('rolesTableBody');
    const firstRow = tbody.querySelector('tr');
    if (firstRow && firstRow.querySelector('td[colspan]')) firstRow.remove();
    tbody.insertAdjacentHTML('afterbegin', newRow);
    setTimeout(() => {
        const newRowElement = document.querySelector(`tr[data-role-id="${role.id}"]`);
        if (newRowElement) newRowElement.classList.remove('fade-in');
    }, 300);
}
function editRole(roleId) { openRoleModal(roleId); }
function deleteRole(roleId) {
    if (confirm('Are you sure you want to delete this role? This action cannot be undone.')) {
        const row = document.querySelector(`tr[data-role-id="${roleId}"]`);
        fetch(`/roles/${roleId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                row.classList.add('fade-out');
                setTimeout(() => { row.remove(); if (document.getElementById('rolesTableBody').children.length === 0) location.reload(); }, 300);
                showRoleAlert(data.message, 'success');
            } else {
                showRoleAlert('Error: ' + data.message, 'danger');
            }
        })
        .catch(() => showRoleAlert('An error occurred while deleting the role', 'danger'));
    }
}
function searchRoles() {
    const searchTerm = document.getElementById('roleSearch').value.toLowerCase();
    document.querySelectorAll('#rolesTableBody tr').forEach(row => {
        const name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
        const desc = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        if (name.includes(searchTerm) || desc.includes(searchTerm)) row.style.display = ''; else row.style.display = 'none';
    });
}
function showRoleAlert(message, type) {
    const alertHtml = `<div class="alert alert-${type} alert-dismissible fade show" role="alert">${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>`;
    const alertContainer = document.getElementById('alertContainer');
    alertContainer.innerHTML = alertHtml;
    setTimeout(() => {
        const alert = alertContainer.querySelector('.alert');
        if (alert) { const bsAlert = new bootstrap.Alert(alert); bsAlert.close(); }
    }, 5000);
}
function validateRoleForm() {
    const name = document.getElementById('roleName');
    let valid = true;
    if (!name.value.trim()) { name.classList.add('is-invalid'); valid = false; } else { name.classList.remove('is-invalid'); name.classList.add('is-valid'); }
    return valid;
}
</script>
@endpush 