<div class="modal fade" id="roleModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roleModalTitle">Add New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="roleForm">
                    <input type="hidden" id="roleId">
                    <div class="mb-3">
                        <label class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="roleName" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="roleDescription" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div class="row" id="rolePermissions">
                            <div class="col-md-6">
                                <h6>User Management</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="users.view" id="perm_users_view">
                                    <label class="form-check-label" for="perm_users_view">View Users</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="users.create" id="perm_users_create">
                                    <label class="form-check-label" for="perm_users_create">Create Users</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="users.edit" id="perm_users_edit">
                                    <label class="form-check-label" for="perm_users_edit">Edit Users</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="users.delete" id="perm_users_delete">
                                    <label class="form-check-label" for="perm_users_delete">Delete Users</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Appointments</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="appointments.view" id="perm_appointments_view">
                                    <label class="form-check-label" for="perm_appointments_view">View Appointments</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="appointments.create" id="perm_appointments_create">
                                    <label class="form-check-label" for="perm_appointments_create">Create Appointments</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="appointments.edit" id="perm_appointments_edit">
                                    <label class="form-check-label" for="perm_appointments_edit">Edit Appointments</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="appointments.delete" id="perm_appointments_delete">
                                    <label class="form-check-label" for="perm_appointments_delete">Delete Appointments</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveRole()">Save Role</button>
            </div>
        </div>
    </div>
</div> 