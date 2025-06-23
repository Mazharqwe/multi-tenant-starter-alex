@extends('tenant.layouts.app')

@section('title', 'Users Management')
@section('page-title', 'Users Management')

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

.avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 14px;
}

.user-checkbox:checked {
    background-color: #007bff;
    border-color: #007bff;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}

.btn-group-sm .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

.alert {
    border-radius: 0.5rem;
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.form-control:focus,
.form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.is-valid {
    border-color: #28a745 !important;
}

.is-invalid {
    border-color: #dc3545 !important;
}

.invalid-feedback {
    display: block;
}

.valid-feedback {
    display: block;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
}

.dropdown-item.text-danger:hover {
    background-color: #dc3545;
    color: white !important;
}

#bulkActionsDropdown {
    transition: opacity 0.3s ease;
}

.table-responsive {
    border-radius: 0.5rem;
    overflow: hidden;
}

.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border-radius: 0.5rem;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.badge {
    font-size: 0.75em;
    padding: 0.375em 0.75em;
}

.btn {
    border-radius: 0.375rem;
    font-weight: 500;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

.btn-outline-primary {
    color: #007bff;
    border-color: #007bff;
}

.btn-outline-primary:hover {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-outline-warning {
    color: #ffc107;
    border-color: #ffc107;
}

.btn-outline-warning:hover {
    background-color: #ffc107;
    border-color: #ffc107;
    color: #212529;
}

.btn-outline-danger {
    color: #dc3545;
    border-color: #dc3545;
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-outline-secondary {
    color: #6c757d;
    border-color: #6c757d;
}

.btn-outline-secondary:hover {
    background-color: #6c757d;
    border-color: #6c757d;
}

/* Animation for row updates */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeOut {
    from { opacity: 1; transform: translateY(0); }
    to { opacity: 0; transform: translateY(-10px); }
}

.fade-in {
    animation: fadeIn 0.3s ease-in;
}

.fade-out {
    animation: fadeOut 0.3s ease-out;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .btn-group-sm .btn {
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
    }
    
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .avatar {
        width: 28px;
        height: 28px;
        font-size: 12px;
    }
}
</style>
@endpush

@section('content')
<div class="page-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Users Management</h2>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary" onclick="exportUsers()" title="Export Users">
                <i class="bi bi-download me-2"></i>
                Export
            </button>
            <button class="btn btn-primary" onclick="openUserModal()">
                <i class="bi bi-plus-circle me-2"></i>
                Add User
            </button>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <div id="alertContainer"></div>

    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">All Users</h5>
                </div>
                <div class="col-auto">
                    <div class="d-flex gap-2">
                        <!-- Bulk Actions -->
                        <div class="dropdown" id="bulkActionsDropdown" style="display: none;">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-gear me-2"></i>
                                Bulk Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="bulkAction('activate')">
                                    <i class="bi bi-check-circle me-2"></i>Activate Selected
                                </a></li>
                                <li><a class="dropdown-item" href="#" onclick="bulkAction('deactivate')">
                                    <i class="bi bi-x-circle me-2"></i>Deactivate Selected
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="#" onclick="bulkAction('delete')">
                                    <i class="bi bi-trash me-2"></i>Delete Selected
                                </a></li>
                            </ul>
                        </div>
                        
                        <!-- Search -->
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search users..." id="userSearch" onkeyup="searchUsers()">
                            <button class="btn btn-outline-secondary" onclick="searchUsers()">
                                <i class="bi bi-search"></i>
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
                            <th>
                                <input type="checkbox" class="form-check-input" id="selectAll" onchange="toggleSelectAll()">
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Appointments</th>
                            <th>Last Login</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        @forelse($users as $user)
                        <tr data-user-id="{{ $user->id }}">
                            <td>
                                <input type="checkbox" class="form-check-input user-checkbox" value="{{ $user->id }}" onchange="updateBulkActions()">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-primary me-2">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $user->name }}</div>
                                        <small class="text-muted">{{ $user->phone }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-info">{{ ucfirst($user->role) }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}" id="status-{{ $user->id }}">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $user->appointments_count }}</span>
                            </td>
                            <td>{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary" onclick="editUser({{ $user->id }})" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-outline-warning" onclick="toggleUserStatus({{ $user->id }})" title="Toggle Status">
                                        <i class="bi bi-toggle-on"></i>
                                    </button>
                                    <button class="btn btn-outline-danger" onclick="deleteUser({{ $user->id }})" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="bi bi-people display-4 d-block mb-3"></i>
                                <h5>No Users Found</h5>
                                <p>Get started by adding your first user.</p>
                                <button class="btn btn-primary" onclick="openUserModal()">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    Add User
                                </button>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        @if($users->hasPages())
        <div class="card-footer">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>

<!-- User Modal -->
@include('tenant.components.user-modal')
@endsection

@push('scripts')
<script>
let currentUserId = null;

function openUserModal(userId = null) {
    console.log('openUserModal called with userId:', userId);
    
    currentUserId = userId;
    const modal = document.getElementById('userModal');
    
    if (!modal) {
        console.error('Modal element not found!');
        alert('Modal not found. Please check the page.');
        return;
    }
    
    const bsModal = new bootstrap.Modal(modal);
    const title = modal.querySelector('#userModalTitle');
    const form = modal.querySelector('#userForm');
    
    // Reset form
    form.reset();
    modal.querySelector('#userId').value = '';
    
    // Clear validation classes
    const inputs = form.querySelectorAll('.is-valid, .is-invalid');
    inputs.forEach(input => {
        input.classList.remove('is-valid', 'is-invalid');
    });
    
    if (userId) {
        title.textContent = 'Edit User';
        loadUserData(userId);
    } else {
        title.textContent = 'Add New User';
    }
    
    bsModal.show();
}

function loadUserData(userId) {
    console.log('Loading user data for ID:', userId);
    
    fetch(`/users/${userId}/edit`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('User data loaded:', data);
        if (data.success) {
            const user = data.user;
            document.getElementById('userId').value = user.id;
            document.getElementById('userName').value = user.name;
            document.getElementById('userEmail').value = user.email;
            document.getElementById('userPhone').value = user.phone || '';
            document.getElementById('userRole').value = user.role;
            document.getElementById('userStatus').value = user.is_active ? '1' : '0';
        }
    })
    .catch(error => {
        console.error('Error loading user data:', error);
        showAlert('Error loading user data', 'danger');
    });
}

function saveUser() {
    console.log('saveUser function called');
    
    // Validate form first
    if (!validateForm()) {
        showAlert('Please fill in all required fields correctly', 'warning');
        return;
    }
    
    const formData = {
        id: document.getElementById('userId').value,
        name: document.getElementById('userName').value,
        email: document.getElementById('userEmail').value,
        phone: document.getElementById('userPhone').value,
        role: document.getElementById('userRole').value,
        status: document.getElementById('userStatus').value,
        password: document.getElementById('userPassword').value
    };
    
    console.log('Form data:', formData);
    
    const url = formData.id ? `/users/${formData.id}` : '/users';
    const method = formData.id ? 'PUT' : 'POST';
    
    // Show loading state
    const saveBtn = document.querySelector('.modal-footer .btn-primary');
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
    .then(response => {
        console.log('Response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            const modal = document.getElementById('userModal');
            const bsModal = bootstrap.Modal.getInstance(modal);
            bsModal.hide();
            
            showAlert(data.message, 'success');
            
            if (formData.id) {
                // Update existing row
                updateUserRow(data.user);
            } else {
                // Add new row
                addUserRow(data.user);
            }
            
            // Reset form
            document.getElementById('userForm').reset();
            const inputs = document.querySelectorAll('#userForm .is-valid, #userForm .is-invalid');
            inputs.forEach(input => {
                input.classList.remove('is-valid', 'is-invalid');
            });
        } else {
            showAlert('Error: ' + data.message, 'danger');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('An error occurred while saving the user', 'danger');
    })
    .finally(() => {
        // Reset button state
        saveBtn.innerHTML = originalText;
        saveBtn.disabled = false;
    });
}

function updateUserRow(user) {
    const row = document.querySelector(`tr[data-user-id="${user.id}"]`);
    if (row) {
        row.querySelector('td:nth-child(2) .fw-bold').textContent = user.name;
        row.querySelector('td:nth-child(2) small').textContent = user.phone || '';
        row.querySelector('td:nth-child(3)').textContent = user.email;
        row.querySelector('td:nth-child(4) .badge').textContent = user.role.charAt(0).toUpperCase() + user.role.slice(1);
        
        const statusBadge = row.querySelector('td:nth-child(5) .badge');
        statusBadge.textContent = user.is_active ? 'Active' : 'Inactive';
        statusBadge.className = `badge ${user.is_active ? 'bg-success' : 'bg-danger'}`;
        
        row.querySelector('td:nth-child(6) .badge').textContent = user.appointments_count;
    }
}

function addUserRow(user) {
    const newRow = `
        <tr data-user-id="${user.id}" class="fade-in">
            <td>
                <input type="checkbox" class="form-check-input user-checkbox" value="${user.id}" onchange="updateBulkActions()">
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="avatar bg-primary me-2">
                        ${user.name.charAt(0).toUpperCase()}
                    </div>
                    <div>
                        <div class="fw-bold">${user.name}</div>
                        <small class="text-muted">${user.phone || ''}</small>
                    </div>
                </div>
            </td>
            <td>${user.email}</td>
            <td>
                <span class="badge bg-info">${user.role.charAt(0).toUpperCase() + user.role.slice(1)}</span>
            </td>
            <td>
                <span class="badge ${user.is_active ? 'bg-success' : 'bg-danger'}" id="status-${user.id}">
                    ${user.is_active ? 'Active' : 'Inactive'}
                </span>
            </td>
            <td>
                <span class="badge bg-secondary">${user.appointments_count || 0}</span>
            </td>
            <td>Never</td>
            <td>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary" onclick="editUser(${user.id})" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-outline-warning" onclick="toggleUserStatus(${user.id})" title="Toggle Status">
                        <i class="bi bi-toggle-on"></i>
                    </button>
                    <button class="btn btn-outline-danger" onclick="deleteUser(${user.id})" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
    `;
    
    const tbody = document.getElementById('usersTableBody');
    
    // Remove empty state row if exists
    const firstRow = tbody.querySelector('tr');
    if (firstRow && firstRow.querySelector('td[colspan]')) {
        firstRow.remove();
    }
    
    // Add new row at the beginning
    tbody.insertAdjacentHTML('afterbegin', newRow);
    
    // Remove animation class after animation completes
    setTimeout(() => {
        const newRowElement = document.querySelector(`tr[data-user-id="${user.id}"]`);
        if (newRowElement) {
            newRowElement.classList.remove('fade-in');
        }
    }, 300);
}

function editUser(userId) {
    openUserModal(userId);
}

function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
        const row = document.querySelector(`tr[data-user-id="${userId}"]`);
        
        fetch(`/users/${userId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Add fade-out animation
                row.classList.add('fade-out');
                
                setTimeout(() => {
                    row.remove();
                    // Check if table is empty
                    const tbody = document.getElementById('usersTableBody');
                    if (tbody.children.length === 0) {
                        location.reload(); // Reload to show empty state
                    }
                }, 300);
                
                showAlert(data.message, 'success');
            } else {
                showAlert('Error: ' + data.message, 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred while deleting the user', 'danger');
        });
    }
}

function toggleUserStatus(userId) {
    const statusBadge = document.getElementById(`status-${userId}`);
    const currentStatus = statusBadge.textContent.trim() === 'Active';
    const newStatus = !currentStatus;
    
    fetch(`/users/${userId}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        },
        body: JSON.stringify({
            is_active: newStatus
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            statusBadge.textContent = newStatus ? 'Active' : 'Inactive';
            statusBadge.className = `badge ${newStatus ? 'bg-success' : 'bg-danger'}`;
            showAlert(data.message, 'success');
        } else {
            showAlert('Error: ' + data.message, 'danger');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('An error occurred while updating user status', 'danger');
    });
}

// Bulk Actions
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.user-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    updateBulkActions();
}

function updateBulkActions() {
    const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
    const bulkActionsDropdown = document.getElementById('bulkActionsDropdown');
    
    if (checkedBoxes.length > 0) {
        bulkActionsDropdown.style.display = 'block';
    } else {
        bulkActionsDropdown.style.display = 'none';
    }
}

function bulkAction(action) {
    const selectedIds = Array.from(document.querySelectorAll('.user-checkbox:checked')).map(checkbox => checkbox.value);
    
    if (selectedIds.length === 0) {
        showAlert('Please select at least one user', 'warning');
        return;
    }
    
    let confirmMessage = '';
    let endpoint = '';
    let method = 'PATCH';
    
    switch(action) {
        case 'activate':
            confirmMessage = `Are you sure you want to activate ${selectedIds.length} user(s)?`;
            endpoint = '/users/bulk-activate';
            break;
        case 'deactivate':
            confirmMessage = `Are you sure you want to deactivate ${selectedIds.length} user(s)?`;
            endpoint = '/users/bulk-deactivate';
            break;
        case 'delete':
            confirmMessage = `Are you sure you want to delete ${selectedIds.length} user(s)? This action cannot be undone.`;
            endpoint = '/users/bulk-delete';
            method = 'DELETE';
            break;
    }
    
    if (confirm(confirmMessage)) {
        fetch(endpoint, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                user_ids: selectedIds
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert(data.message, 'success');
                location.reload(); // Reload to reflect changes
            } else {
                showAlert('Error: ' + data.message, 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred while performing bulk action', 'danger');
        });
    }
}

function exportUsers() {
    // Create CSV content
    const headers = ['Name', 'Email', 'Phone', 'Role', 'Status', 'Appointments', 'Last Login'];
    const rows = [];
    
    document.querySelectorAll('#usersTableBody tr').forEach(function(row) {
        const cells = row.querySelectorAll('td');
        if (cells.length > 1) { // Skip empty state row
            const rowData = [
                cells[1].querySelector('.fw-bold').textContent,
                cells[2].textContent,
                cells[1].querySelector('small').textContent,
                cells[3].querySelector('.badge').textContent,
                cells[4].querySelector('.badge').textContent,
                cells[5].querySelector('.badge').textContent,
                cells[6].textContent
            ];
            rows.push(rowData);
        }
    });
    
    const csvContent = [headers, ...rows]
        .map(row => row.map(cell => `"${cell}"`).join(','))
        .join('\n');
    
    // Download CSV file
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'users-export.csv';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
    
    showAlert('Users exported successfully', 'success');
}

function searchUsers() {
    const searchTerm = document.getElementById('userSearch').value.toLowerCase();
    const rows = document.querySelectorAll('#usersTableBody tr');
    
    rows.forEach(function(row) {
        const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
        const role = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
        
        if (name.includes(searchTerm) || email.includes(searchTerm) || role.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function showAlert(message, type) {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    const alertContainer = document.getElementById('alertContainer');
    alertContainer.innerHTML = alertHtml;
    
    // Auto-dismiss after 5 seconds
    setTimeout(() => {
        const alert = alertContainer.querySelector('.alert');
        if (alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 5000);
}

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endpush 