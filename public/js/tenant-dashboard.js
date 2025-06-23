// Tenant Dashboard JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Sidebar toggle functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
    }
    
    // Close sidebar on mobile when clicking outside
    document.addEventListener('click', function(e) {
        if (window.innerWidth < 992) {
            if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                sidebar.classList.remove('show');
            }
        }
    });
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Initialize popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
});

// User Management Functions
function saveUser() {
    const formData = {
        id: document.getElementById('userId').value,
        name: document.getElementById('userName').value,
        email: document.getElementById('userEmail').value,
        phone: document.getElementById('userPhone').value,
        role: document.getElementById('userRole').value,
        status: document.getElementById('userStatus').value,
        password: document.getElementById('userPassword').value
    };
    
    // Validate form
    if (!formData.name || !formData.email || !formData.role) {
        alert('Please fill in all required fields');
        return;
    }
    
    // Send AJAX request
    const url = formData.id ? `/users/${formData.id}` : '/users';
    const method = formData.id ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            $('#userModal').modal('hide');
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while saving the user');
    });
}

// Role Management Functions
function saveRole() {
    const formData = {
        id: document.getElementById('roleId').value,
        name: document.getElementById('roleName').value,
        description: document.getElementById('roleDescription').value,
        permissions: Array.from(document.querySelectorAll('#rolePermissions input:checked')).map(cb => cb.value)
    };
    
    // Validate form
    if (!formData.name) {
        alert('Please fill in all required fields');
        return;
    }
    
    // Send AJAX request
    const url = formData.id ? `/roles/${formData.id}` : '/roles';
    const method = formData.id ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            $('#roleModal').modal('hide');
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while saving the role');
    });
}

// Permission Management Functions
function savePermission() {
    const formData = {
        id: document.getElementById('permissionId').value,
        name: document.getElementById('permissionName').value,
        description: document.getElementById('permissionDescription').value,
        category: document.getElementById('permissionCategory').value,
        roles: Array.from(document.querySelectorAll('#permissionRoles input:checked')).map(cb => cb.value)
    };
    
    // Validate form
    if (!formData.name || !formData.category) {
        alert('Please fill in all required fields');
        return;
    }
    
    // Send AJAX request
    const url = formData.id ? `/permissions/${formData.id}` : '/permissions';
    const method = formData.id ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            $('#permissionModal').modal('hide');
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while saving the permission');
    });
}

// Service Management Functions
function saveService() {
    const formData = {
        id: document.getElementById('serviceId').value,
        name: document.getElementById('serviceName').value,
        description: document.getElementById('serviceDescription').value,
        price: document.getElementById('servicePrice').value,
        duration: document.getElementById('serviceDuration').value,
        category: document.getElementById('serviceCategory').value,
        status: document.getElementById('serviceStatus').value,
        color: document.getElementById('serviceColor').value
    };
    
    // Validate form
    if (!formData.name || !formData.price || !formData.duration) {
        alert('Please fill in all required fields');
        return;
    }
    
    // Send AJAX request
    const url = formData.id ? `/services/${formData.id}` : '/services';
    const method = formData.id ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            $('#serviceModal').modal('hide');
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while saving the service');
    });
}

// Staff Management Functions
function saveStaff() {
    const formData = {
        id: document.getElementById('staffId').value,
        first_name: document.getElementById('staffFirstName').value,
        last_name: document.getElementById('staffLastName').value,
        email: document.getElementById('staffEmail').value,
        phone: document.getElementById('staffPhone').value,
        position: document.getElementById('staffPosition').value,
        specialization: document.getElementById('staffSpecialization').value,
        hire_date: document.getElementById('staffHireDate').value,
        status: document.getElementById('staffStatus').value,
        bio: document.getElementById('staffBio').value,
        password: document.getElementById('staffPassword').value,
        services: Array.from(document.querySelectorAll('#staffServices input:checked')).map(cb => cb.value)
    };
    
    // Validate form
    if (!formData.first_name || !formData.last_name || !formData.email || !formData.position) {
        alert('Please fill in all required fields');
        return;
    }
    
    // Send AJAX request
    const url = formData.id ? `/staff/${formData.id}` : '/staff';
    const method = formData.id ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            $('#staffModal').modal('hide');
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while saving the staff member');
    });
}

// Appointment Management Functions
function saveAppointment() {
    const formData = {
        id: document.getElementById('appointmentId').value,
        customer_id: document.getElementById('appointmentCustomer').value,
        service_id: document.getElementById('appointmentService').value,
        staff_id: document.getElementById('appointmentStaff').value,
        appointment_date: document.getElementById('appointmentDate').value,
        appointment_time: document.getElementById('appointmentTime').value,
        duration: document.getElementById('appointmentDuration').value,
        status: document.getElementById('appointmentStatus').value,
        notes: document.getElementById('appointmentNotes').value
    };
    
    // Validate form
    if (!formData.customer_id || !formData.service_id || !formData.staff_id || 
        !formData.appointment_date || !formData.appointment_time) {
        alert('Please fill in all required fields');
        return;
    }
    
    // Send AJAX request
    const url = formData.id ? `/appointments/${formData.id}` : '/appointments';
    const method = formData.id ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            $('#appointmentModal').modal('hide');
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while saving the appointment');
    });
}

// Auto-update duration when service is selected
document.addEventListener('DOMContentLoaded', function() {
    const serviceSelect = document.getElementById('appointmentService');
    const durationInput = document.getElementById('appointmentDuration');
    
    if (serviceSelect && durationInput) {
        serviceSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const duration = selectedOption.getAttribute('data-duration');
            if (duration) {
                durationInput.value = duration;
            }
        });
    }
});

// Search functionality
function searchUsers() {
    const searchTerm = document.getElementById('userSearch').value.toLowerCase();
    const tableBody = document.getElementById('usersTableBody');
    const rows = tableBody.getElementsByTagName('tr');
    
    for (let row of rows) {
        const name = row.cells[0]?.textContent.toLowerCase() || '';
        const email = row.cells[1]?.textContent.toLowerCase() || '';
        
        if (name.includes(searchTerm) || email.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
}

function searchAppointments() {
    const searchTerm = document.getElementById('appointmentSearch').value.toLowerCase();
    const tableBody = document.getElementById('appointmentsTableBody');
    const rows = tableBody.getElementsByTagName('tr');
    
    for (let row of rows) {
        const customer = row.cells[0]?.textContent.toLowerCase() || '';
        const service = row.cells[1]?.textContent.toLowerCase() || '';
        
        if (customer.includes(searchTerm) || service.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
}

// Status filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const statusFilter = document.getElementById('appointmentStatusFilter');
    if (statusFilter) {
        statusFilter.addEventListener('change', function() {
            const selectedStatus = this.value.toLowerCase();
            const tableBody = document.getElementById('appointmentsTableBody');
            const rows = tableBody.getElementsByTagName('tr');
            
            for (let row of rows) {
                const statusCell = row.cells[5];
                if (statusCell) {
                    const status = statusCell.textContent.toLowerCase();
                    if (!selectedStatus || status.includes(selectedStatus)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            }
        });
    }
}); 