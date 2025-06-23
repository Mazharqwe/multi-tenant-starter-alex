@extends('tenant.layouts.app')

@section('title', 'Permissions Management')
@section('page-title', 'Permissions Management')

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
        <h2>Permissions Management</h2>
        <button class="btn btn-primary" onclick="openPermissionModal()">
            <i class="bi bi-plus-circle me-2"></i>
            Add Permission
        </button>
    </div>
    <div id="alertContainer"></div>
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">All Permissions</h5>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search permissions..." id="permissionSearch" onkeyup="searchPermissions()">
                        <button class="btn btn-outline-secondary" onclick="searchPermissions()">
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="permissionsTableBody">
                        @forelse($permissions as $permission)
                        <tr data-permission-id="{{ $permission->id }}">
                            <td><span class="fw-bold">{{ $permission->name }}</span></td>
                            <td>{{ $permission->description }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary" onclick="editPermission({{ $permission->id }})" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-outline-danger" onclick="deletePermission({{ $permission->id }})" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                                <i class="bi bi-key display-4 d-block mb-3"></i>
                                <h5>No Permissions Found</h5>
                                <p>Get started by adding your first permission.</p>
                                <button class="btn btn-primary" onclick="openPermissionModal()">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    Add Permission
                                </button>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($permissions->hasPages())
        <div class="card-footer">
            {{ $permissions->links() }}
        </div>
        @endif
    </div>
</div>
@include('tenant.components.permission-modal')
@endsection

@push('scripts')
<script>
let currentPermissionId = null;
function openPermissionModal(permissionId = null) {
    currentPermissionId = permissionId;
    const modal = document.getElementById('permissionModal');
    if (!modal) return alert('Modal not found!');
    const bsModal = new bootstrap.Modal(modal);
    const title = modal.querySelector('#permissionModalTitle');
    const form = modal.querySelector('#permissionForm');
    form.reset();
    modal.querySelector('#permissionId').value = '';
    form.querySelectorAll('.is-valid, .is-invalid').forEach(input => input.classList.remove('is-valid', 'is-invalid'));
    if (permissionId) {
        title.textContent = 'Edit Permission';
        loadPermissionData(permissionId);
    } else {
        title.textContent = 'Add New Permission';
    }
    bsModal.show();
}
function loadPermissionData(permissionId) {
    fetch(`/permissions/${permissionId}/edit`, {
        method: 'GET',
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const permission = data.permission;
            document.getElementById('permissionId').value = permission.id;
            document.getElementById('permissionName').value = permission.name;
            document.getElementById('permissionDescription').value = permission.description || '';
        }
    });
}
function savePermission() {
    if (!validatePermissionForm()) {
        showPermissionAlert('Please fill in all required fields', 'warning');
        return;
    }
    const formData = {
        id: document.getElementById('permissionId').value,
        name: document.getElementById('permissionName').value,
        description: document.getElementById('permissionDescription').value
    };
    const url = formData.id ? `/permissions/${formData.id}` : '/permissions';
    const method = formData.id ? 'PUT' : 'POST';
    const saveBtn = document.querySelector('#permissionModal .btn-primary');
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
            const modal = document.getElementById('permissionModal');
            const bsModal = bootstrap.Modal.getInstance(modal);
            bsModal.hide();
            showPermissionAlert(data.message, 'success');
            if (formData.id) updatePermissionRow(data.permission); else addPermissionRow(data.permission);
            form.reset();
            form.querySelectorAll('.is-valid, .is-invalid').forEach(input => input.classList.remove('is-valid', 'is-invalid'));
        } else {
            showPermissionAlert('Error: ' + data.message, 'danger');
        }
    })
    .catch(() => showPermissionAlert('An error occurred while saving the permission', 'danger'))
    .finally(() => { saveBtn.innerHTML = originalText; saveBtn.disabled = false; });
}
function updatePermissionRow(permission) {
    const row = document.querySelector(`tr[data-permission-id="${permission.id}"]`);
    if (row) {
        row.querySelector('td:nth-child(1) .fw-bold').textContent = permission.name;
        row.querySelector('td:nth-child(2)').textContent = permission.description || '';
    }
}
function addPermissionRow(permission) {
    const newRow = `<tr data-permission-id="${permission.id}" class="fade-in">
        <td><span class="fw-bold">${permission.name}</span></td>
        <td>${permission.description || ''}</td>
        <td>
            <div class="btn-group btn-group-sm">
                <button class="btn btn-outline-primary" onclick="editPermission(${permission.id})" title="Edit"><i class="bi bi-pencil"></i></button>
                <button class="btn btn-outline-danger" onclick="deletePermission(${permission.id})" title="Delete"><i class="bi bi-trash"></i></button>
            </div>
        </td>
    </tr>`;
    const tbody = document.getElementById('permissionsTableBody');
    const firstRow = tbody.querySelector('tr');
    if (firstRow && firstRow.querySelector('td[colspan]')) firstRow.remove();
    tbody.insertAdjacentHTML('afterbegin', newRow);
    setTimeout(() => {
        const newRowElement = document.querySelector(`tr[data-permission-id="${permission.id}"]`);
        if (newRowElement) newRowElement.classList.remove('fade-in');
    }, 300);
}
function editPermission(permissionId) { openPermissionModal(permissionId); }
function deletePermission(permissionId) {
    if (confirm('Are you sure you want to delete this permission? This action cannot be undone.')) {
        const row = document.querySelector(`tr[data-permission-id="${permissionId}"]`);
        fetch(`/permissions/${permissionId}`, {
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
                setTimeout(() => { row.remove(); if (document.getElementById('permissionsTableBody').children.length === 0) location.reload(); }, 300);
                showPermissionAlert(data.message, 'success');
            } else {
                showPermissionAlert('Error: ' + data.message, 'danger');
            }
        })
        .catch(() => showPermissionAlert('An error occurred while deleting the permission', 'danger'));
    }
}
function searchPermissions() {
    const searchTerm = document.getElementById('permissionSearch').value.toLowerCase();
    document.querySelectorAll('#permissionsTableBody tr').forEach(row => {
        const name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
        const desc = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        if (name.includes(searchTerm) || desc.includes(searchTerm)) row.style.display = ''; else row.style.display = 'none';
    });
}
function showPermissionAlert(message, type) {
    const alertHtml = `<div class="alert alert-${type} alert-dismissible fade show" role="alert">${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>`;
    const alertContainer = document.getElementById('alertContainer');
    alertContainer.innerHTML = alertHtml;
    setTimeout(() => {
        const alert = alertContainer.querySelector('.alert');
        if (alert) { const bsAlert = new bootstrap.Alert(alert); bsAlert.close(); }
    }, 5000);
}
function validatePermissionForm() {
    const name = document.getElementById('permissionName');
    let valid = true;
    if (!name.value.trim()) { name.classList.add('is-invalid'); valid = false; } else { name.classList.remove('is-invalid'); name.classList.add('is-valid'); }
    return valid;
}
</script>
@endpush 