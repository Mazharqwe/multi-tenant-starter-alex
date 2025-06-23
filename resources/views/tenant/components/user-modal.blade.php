<div class="modal fade" id="userModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalTitle">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="userForm" novalidate>
                    <input type="hidden" id="userId">
                    
                    <div class="mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="userName" required>
                        <div class="invalid-feedback">
                            Please provide a valid name.
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="userEmail" required>
                        <div class="invalid-feedback">
                            Please provide a valid email address.
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="userPhone" placeholder="+1 (555) 123-4567">
                        <div class="form-text">Optional phone number</div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Role <span class="text-danger">*</span></label>
                        <select class="form-select" id="userRole" required>
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                            <option value="customer">Customer</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a role.
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="userStatus">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Password <span class="text-danger password-required">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="userPassword">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                <i class="bi bi-eye" id="passwordToggleIcon"></i>
                            </button>
                        </div>
                        <div class="form-text password-hint">Leave blank to keep current password when editing</div>
                        <div class="invalid-feedback">
                            Password is required for new users.
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveUser()">
                    <i class="bi bi-check-circle me-2"></i>
                    Save User
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('userPassword');
    const toggleIcon = document.getElementById('passwordToggleIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
    }
}

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('userForm');
    const inputs = form.querySelectorAll('input, select');
    
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                validateField(this);
            }
        });
    });
    
    // Handle password field requirements
    const userIdInput = document.getElementById('userId');
    const passwordInput = document.getElementById('userPassword');
    const passwordRequired = document.querySelector('.password-required');
    const passwordHint = document.querySelector('.password-hint');
    
    function updatePasswordRequirements() {
        const isEditMode = userIdInput.value !== '';
        passwordRequired.style.display = isEditMode ? 'none' : 'inline';
        passwordHint.textContent = isEditMode ? 'Leave blank to keep current password when editing' : 'Password is required for new users';
        passwordInput.required = !isEditMode;
    }
    
    // Update requirements when modal opens
    $('#userModal').on('show.bs.modal', function() {
        updatePasswordRequirements();
    });
});

function validateField(field) {
    const isValid = field.checkValidity();
    
    if (isValid) {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
    } else {
        field.classList.remove('is-valid');
        field.classList.add('is-invalid');
    }
    
    return isValid;
}

function validateForm() {
    const form = document.getElementById('userForm');
    const inputs = form.querySelectorAll('input[required], select[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!validateField(input)) {
            isValid = false;
        }
    });
    
    // Special validation for password
    const userId = document.getElementById('userId').value;
    const password = document.getElementById('userPassword').value;
    
    if (!userId && !password) {
        const passwordInput = document.getElementById('userPassword');
        passwordInput.classList.remove('is-valid');
        passwordInput.classList.add('is-invalid');
        isValid = false;
    }
    
    return isValid;
}
</script> 