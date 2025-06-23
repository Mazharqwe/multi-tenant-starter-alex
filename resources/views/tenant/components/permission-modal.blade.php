<div class="modal fade" id="permissionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="permissionModalTitle">Add New Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="permissionForm">
                    <input type="hidden" id="permissionId">
                    <div class="mb-3">
                        <label class="form-label">Permission Name</label>
                        <input type="text" class="form-control" id="permissionName" placeholder="e.g., users.create" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="permissionDescription" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select" id="permissionCategory" required>
                            <option value="">Select Category</option>
                            <option value="User Management">User Management</option>
                            <option value="Role Management">Role Management</option>
                            <option value="Appointments">Appointments</option>
                            <option value="Services">Services</option>
                            <option value="Staff">Staff</option>
                            <option value="System Settings">System Settings</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Assign to Roles</label>
                        <div id="permissionRoles">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="admin" id="role_admin">
                                <label class="form-check-label" for="role_admin">Admin</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="staff" id="role_staff">
                                <label class="form-check-label" for="role_staff">Staff</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="customer" id="role_customer">
                                <label class="form-check-label" for="role_customer">Customer</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="savePermission()">Save Permission</button>
            </div>
        </div>
    </div>
</div> 