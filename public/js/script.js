// Dashboard Data Storage
const dashboardData = {
    users: [
      { id: 1, name: "John Doe", email: "john@example.com", role: "Admin", status: "Active", lastLogin: "2024-01-15" },
      {
        id: 2,
        name: "Jane Smith",
        email: "jane@example.com",
        role: "Manager",
        status: "Active",
        lastLogin: "2024-01-14",
      },
      { id: 3, name: "Bob Johnson", email: "bob@example.com", role: "User", status: "Inactive", lastLogin: "2024-01-10" },
    ],
    roles: [
      {
        id: 1,
        name: "Admin",
        description: "Full system access",
        permissions: ["users.create", "users.read", "users.update", "users.delete", "roles.manage"],
        userCount: 2,
      },
      {
        id: 2,
        name: "Manager",
        description: "Limited management access",
        permissions: ["users.read", "users.update", "appointments.manage"],
        userCount: 5,
      },
      {
        id: 3,
        name: "User",
        description: "Basic user access",
        permissions: ["appointments.read", "profile.update"],
        userCount: 25,
      },
    ],
    permissions: [
      { id: 1, name: "users.create", description: "Create new users", category: "User Management", roles: ["Admin"] },
      {
        id: 2,
        name: "users.read",
        description: "View user information",
        category: "User Management",
        roles: ["Admin", "Manager"],
      },
      {
        id: 3,
        name: "users.update",
        description: "Update user information",
        category: "User Management",
        roles: ["Admin", "Manager"],
      },
      { id: 4, name: "users.delete", description: "Delete users", category: "User Management", roles: ["Admin"] },
      {
        id: 5,
        name: "appointments.create",
        description: "Create appointments",
        category: "Appointments",
        roles: ["Admin", "Manager", "User"],
      },
      {
        id: 6,
        name: "appointments.read",
        description: "View appointments",
        category: "Appointments",
        roles: ["Admin", "Manager", "User"],
      },
    ],
    appointments: [
      {
        id: 1,
        title: "Consultation",
        client: "John Doe",
        date: "2024-01-20",
        time: "10:00",
        duration: 60,
        status: "Scheduled",
        type: "Consultation",
        notes: "Initial consultation for new client",
      },
      {
        id: 2,
        title: "Follow-up Meeting",
        client: "Jane Smith",
        date: "2024-01-20",
        time: "14:00",
        duration: 30,
        status: "Confirmed",
        type: "Follow-up",
      },
      {
        id: 3,
        title: "Team Review",
        client: "Internal",
        date: "2024-01-21",
        time: "09:00",
        duration: 90,
        status: "Scheduled",
        type: "Meeting",
      },
    ],
  }
  
  // Current editing state
  let currentEditingId = null
  let currentEditingType = null
  
  // Bootstrap library
  const bootstrap = window.bootstrap
  
  // Initialize Dashboard
  document.addEventListener("DOMContentLoaded", () => {
    initializeNavigation()
    loadDashboardData()
    updateDashboardStats()
  })
  
  // Navigation Functions
  function initializeNavigation() {
    const navButtons = document.querySelectorAll(".nav-btn")
    const sidebarToggle = document.getElementById("sidebarToggle")
    const sidebar = document.getElementById("sidebar")
  
    navButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const page = this.getAttribute("data-page")
        showPage(page)
  
        // Update active state
        navButtons.forEach((btn) => btn.classList.remove("active"))
        this.classList.add("active")
  
        // Update page title
        const pageTitle = this.textContent.trim()
        document.getElementById("pageTitle").textContent = pageTitle
      })
    })
  
    // Sidebar toggle for mobile
    if (sidebarToggle) {
      sidebarToggle.addEventListener("click", () => {
        sidebar.classList.toggle("show")
      })
    }
  }
  
  function showPage(pageName) {
    // Hide all pages
    const pages = document.querySelectorAll(".page-content")
    pages.forEach((page) => page.classList.add("d-none"))
  
    // Show selected page
    const targetPage = document.getElementById(pageName + "-page")
    if (targetPage) {
      targetPage.classList.remove("d-none")
  
      // Load page-specific data
      switch (pageName) {
        case "users":
          loadUsersTable()
          break
        case "roles":
          loadRolesCards()
          break
        case "permissions":
          loadPermissionsTable()
          break
        case "appointments":
          loadAppointmentsTable()
          break
        case "dashboard":
          loadDashboardData()
          break
      }
    }
  }
  
  // Dashboard Functions
  function loadDashboardData() {
    // Update stats
    updateDashboardStats()
  
    // Load recent activity
    const recentActivity = document.getElementById("recentActivity")
    const activities = [
      { icon: "bi-person-plus", text: "New user registered: John Doe", time: "2 hours ago", class: "text-success" },
      {
        icon: "bi-calendar-check",
        text: "Appointment scheduled with Jane Smith",
        time: "4 hours ago",
        class: "text-info",
      },
      { icon: "bi-shield-check", text: "Role permissions updated", time: "1 day ago", class: "text-warning" },
    ]
  
    recentActivity.innerHTML = activities
      .map(
        (activity) => `
          <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
              <div>
                  <i class="${activity.icon} ${activity.class} me-2"></i>
                  ${activity.text}
              </div>
              <small class="text-muted">${activity.time}</small>
          </div>
      `,
      )
      .join("")
  
    // Load upcoming appointments
    const upcomingAppointments = document.getElementById("upcomingAppointments")
    const upcoming = dashboardData.appointments.slice(0, 3)
  
    upcomingAppointments.innerHTML = upcoming
      .map(
        (appointment) => `
          <div class="d-flex justify-content-between py-2 border-bottom">
              <div>
                  <strong>${appointment.title}</strong>
                  <div><small class="text-muted">${appointment.client}</small></div>
              </div>
              <small>${appointment.time}</small>
          </div>
      `,
      )
      .join("")
  }
  
  function updateDashboardStats() {
    document.getElementById("totalUsers").textContent = dashboardData.users.length
    document.getElementById("totalRoles").textContent = dashboardData.roles.length
    document.getElementById("totalPermissions").textContent = dashboardData.permissions.length
    document.getElementById("todayAppointments").textContent = dashboardData.appointments.length
  }
  
  // Users Functions
  function loadUsersTable() {
    const tbody = document.getElementById("usersTableBody")
    tbody.innerHTML = dashboardData.users
      .map(
        (user) => `
          <tr>
              <td>
                  <div class="d-flex align-items-center">
                      <div class="avatar bg-primary me-2">${user.name.charAt(0)}</div>
                      ${user.name}
                  </div>
              </td>
              <td>${user.email}</td>
              <td><span class="badge bg-secondary">${user.role}</span></td>
              <td><span class="badge status-${user.status.toLowerCase()}">${user.status}</span></td>
              <td>${user.lastLogin}</td>
              <td>
                  <div class="btn-group btn-group-sm">
                      <button class="btn btn-outline-primary" onclick="editUser(${user.id})">
                          <i class="bi bi-pencil"></i>
                      </button>
                      <button class="btn btn-outline-danger" onclick="deleteUser(${user.id})">
                          <i class="bi bi-trash"></i>
                      </button>
                  </div>
              </td>
          </tr>
      `,
      )
      .join("")
  }
  
  function openUserModal(userId = null) {
    const modal = new bootstrap.Modal(document.getElementById("userModal"))
    const form = document.getElementById("userForm")
  
    if (userId) {
      const user = dashboardData.users.find((u) => u.id === userId)
      document.getElementById("userModalTitle").textContent = "Edit User"
      document.getElementById("userId").value = user.id
      document.getElementById("userName").value = user.name
      document.getElementById("userEmail").value = user.email
      document.getElementById("userRole").value = user.role
      document.getElementById("userStatus").value = user.status
      currentEditingId = userId
    } else {
      document.getElementById("userModalTitle").textContent = "Add New User"
      form.reset()
      currentEditingId = null
    }
  
    currentEditingType = "user"
    modal.show()
  }
  
  function editUser(userId) {
    openUserModal(userId)
  }
  
  function deleteUser(userId) {
    if (confirm("Are you sure you want to delete this user?")) {
      dashboardData.users = dashboardData.users.filter((user) => user.id !== userId)
      loadUsersTable()
      updateDashboardStats()
      showNotification("User deleted successfully", "success")
    }
  }
  
  function saveUser() {
    const form = document.getElementById("userForm")
    if (!form.checkValidity()) {
      form.reportValidity()
      return
    }
  
    const userData = {
      name: document.getElementById("userName").value,
      email: document.getElementById("userEmail").value,
      role: document.getElementById("userRole").value,
      status: document.getElementById("userStatus").value,
    }
  
    if (currentEditingId) {
      // Update existing user
      const userIndex = dashboardData.users.findIndex((u) => u.id === currentEditingId)
      dashboardData.users[userIndex] = { ...dashboardData.users[userIndex], ...userData }
      showNotification("User updated successfully", "success")
    } else {
      // Add new user
      const newUser = {
        id: Math.max(...dashboardData.users.map((u) => u.id)) + 1,
        ...userData,
        lastLogin: new Date().toISOString().split("T")[0],
      }
      dashboardData.users.push(newUser)
      showNotification("User created successfully", "success")
    }
  
    loadUsersTable()
    updateDashboardStats()
    bootstrap.Modal.getInstance(document.getElementById("userModal")).hide()
  }
  
  function searchUsers() {
    const searchTerm = document.getElementById("userSearch").value.toLowerCase()
    const filteredUsers = dashboardData.users.filter(
      (user) => user.name.toLowerCase().includes(searchTerm) || user.email.toLowerCase().includes(searchTerm),
    )
  
    const tbody = document.getElementById("usersTableBody")
    tbody.innerHTML = filteredUsers
      .map(
        (user) => `
          <tr>
              <td>
                  <div class="d-flex align-items-center">
                      <div class="avatar bg-primary me-2">${user.name.charAt(0)}</div>
                      ${user.name}
                  </div>
              </td>
              <td>${user.email}</td>
              <td><span class="badge bg-secondary">${user.role}</span></td>
              <td><span class="badge status-${user.status.toLowerCase()}">${user.status}</span></td>
              <td>${user.lastLogin}</td>
              <td>
                  <div class="btn-group btn-group-sm">
                      <button class="btn btn-outline-primary" onclick="editUser(${user.id})">
                          <i class="bi bi-pencil"></i>
                      </button>
                      <button class="btn btn-outline-danger" onclick="deleteUser(${user.id})">
                          <i class="bi bi-trash"></i>
                      </button>
                  </div>
              </td>
          </tr>
      `,
      )
      .join("")
  }
  
  // Roles Functions
  function loadRolesCards() {
    const container = document.getElementById("rolesContainer")
    container.innerHTML = dashboardData.roles
      .map(
        (role) => `
          <div class="col-md-4 mb-4">
              <div class="card h-100">
                  <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">${role.name}</h5>
                      <div class="dropdown">
                          <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                              <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu">
                              <li><button class="dropdown-item" onclick="editRole(${role.id})">
                                  <i class="bi bi-pencil me-2"></i>Edit
                              </button></li>
                              <li><button class="dropdown-item text-danger" onclick="deleteRole(${role.id})">
                                  <i class="bi bi-trash me-2"></i>Delete
                              </button></li>
                          </ul>
                      </div>
                  </div>
                  <div class="card-body">
                      <p class="card-text text-muted">${role.description}</p>
                      <div class="mb-3">
                          <small class="text-muted">Permissions:</small>
                          <div class="mt-1">
                              ${role.permissions
                                .slice(0, 3)
                                .map(
                                  (permission) => `<span class="badge bg-light text-dark me-1 mb-1">${permission}</span>`,
                                )
                                .join("")}
                              ${
                                role.permissions.length > 3
                                  ? `<span class="badge bg-secondary">+${role.permissions.length - 3} more</span>`
                                  : ""
                              }
                          </div>
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                          <small class="text-muted">
                              <i class="bi bi-people me-1"></i>
                              ${role.userCount} users
                          </small>
                          <button class="btn btn-sm btn-outline-primary" onclick="editRole(${role.id})">
                              Manage
                          </button>
                      </div>
                  </div>
              </div>
          </div>
      `,
      )
      .join("")
  }
  
  function openRoleModal(roleId = null) {
    const modal = new bootstrap.Modal(document.getElementById("roleModal"))
    const form = document.getElementById("roleForm")
  
    // Populate permissions checkboxes
    const permissionsContainer = document.getElementById("rolePermissions")
    const availablePermissions = [
      "users.create",
      "users.read",
      "users.update",
      "users.delete",
      "roles.create",
      "roles.read",
      "roles.update",
      "roles.delete",
      "permissions.manage",
      "appointments.create",
      "appointments.read",
      "appointments.update",
      "appointments.delete",
      "profile.update",
    ]
  
    permissionsContainer.innerHTML = availablePermissions
      .map(
        (permission) => `
          <div class="col-md-6 mb-2">
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="perm_${permission}" value="${permission}">
                  <label class="form-check-label" for="perm_${permission}">
                      ${permission}
                  </label>
              </div>
          </div>
      `,
      )
      .join("")
  
    if (roleId) {
      const role = dashboardData.roles.find((r) => r.id === roleId)
      document.getElementById("roleModalTitle").textContent = "Edit Role"
      document.getElementById("roleId").value = role.id
      document.getElementById("roleName").value = role.name
      document.getElementById("roleDescription").value = role.description
  
      // Check permissions
      role.permissions.forEach((permission) => {
        const checkbox = document.getElementById(`perm_${permission}`)
        if (checkbox) checkbox.checked = true
      })
  
      currentEditingId = roleId
    } else {
      document.getElementById("roleModalTitle").textContent = "Add New Role"
      form.reset()
      currentEditingId = null
    }
  
    currentEditingType = "role"
    modal.show()
  }
  
  function editRole(roleId) {
    openRoleModal(roleId)
  }
  
  function deleteRole(roleId) {
    if (confirm("Are you sure you want to delete this role?")) {
      dashboardData.roles = dashboardData.roles.filter((role) => role.id !== roleId)
      loadRolesCards()
      showNotification("Role deleted successfully", "success")
    }
  }
  
  function saveRole() {
    const form = document.getElementById("roleForm")
    if (!form.checkValidity()) {
      form.reportValidity()
      return
    }
  
    const selectedPermissions = Array.from(document.querySelectorAll("#rolePermissions input:checked")).map(
      (checkbox) => checkbox.value,
    )
  
    const roleData = {
      name: document.getElementById("roleName").value,
      description: document.getElementById("roleDescription").value,
      permissions: selectedPermissions,
    }
  
    if (currentEditingId) {
      // Update existing role
      const roleIndex = dashboardData.roles.findIndex((r) => r.id === currentEditingId)
      dashboardData.roles[roleIndex] = { ...dashboardData.roles[roleIndex], ...roleData }
      showNotification("Role updated successfully", "success")
    } else {
      // Add new role
      const newRole = {
        id: Math.max(...dashboardData.roles.map((r) => r.id)) + 1,
        ...roleData,
        userCount: 0,
      }
      dashboardData.roles.push(newRole)
      showNotification("Role created successfully", "success")
    }
  
    loadRolesCards()
    bootstrap.Modal.getInstance(document.getElementById("roleModal")).hide()
  }
  
  // Permissions Functions
  function loadPermissionsTable() {
    const container = document.getElementById("permissionsContainer")
  
    // Group permissions by category
    const groupedPermissions = dashboardData.permissions.reduce((acc, permission) => {
      if (!acc[permission.category]) {
        acc[permission.category] = []
      }
      acc[permission.category].push(permission)
      return acc
    }, {})
  
    container.innerHTML = Object.entries(groupedPermissions)
      .map(
        ([category, permissions]) => `
          <div class="card mb-4">
              <div class="card-header">
                  <h5 class="mb-0">
                      <i class="bi bi-folder me-2"></i>
                      ${category}
                  </h5>
              </div>
              <div class="card-body p-0">
                  <div class="table-responsive">
                      <table class="table table-hover mb-0">
                          <thead class="table-light">
                              <tr>
                                  <th>Permission</th>
                                  <th>Description</th>
                                  <th>Assigned Roles</th>
                                  <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                              ${permissions
                                .map(
                                  (permission) => `
                                  <tr>
                                      <td><code class="bg-light px-2 py-1 rounded">${permission.name}</code></td>
                                      <td>${permission.description}</td>
                                      <td>
                                          ${permission.roles
                                            .map((role) => `<span class="badge bg-secondary me-1">${role}</span>`)
                                            .join("")}
                                      </td>
                                      <td>
                                          <div class="btn-group btn-group-sm">
                                              <button class="btn btn-outline-primary" onclick="editPermission(${permission.id})">
                                                  <i class="bi bi-pencil"></i>
                                              </button>
                                              <button class="btn btn-outline-danger" onclick="deletePermission(${permission.id})">
                                                  <i class="bi bi-trash"></i>
                                              </button>
                                          </div>
                                      </td>
                                  </tr>
                              `,
                                )
                                .join("")}
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      `,
      )
      .join("")
  }
  
  function openPermissionModal(permissionId = null) {
    const modal = new bootstrap.Modal(document.getElementById("permissionModal"))
    const form = document.getElementById("permissionForm")
  
    // Populate roles checkboxes
    const rolesContainer = document.getElementById("permissionRoles")
    const availableRoles = ["Admin", "Manager", "User"]
  
    rolesContainer.innerHTML = availableRoles
      .map(
        (role) => `
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="role_${role}" value="${role}">
              <label class="form-check-label" for="role_${role}">
                  ${role}
              </label>
          </div>
      `,
      )
      .join("")
  
    if (permissionId) {
      const permission = dashboardData.permissions.find((p) => p.id === permissionId)
      document.getElementById("permissionModalTitle").textContent = "Edit Permission"
      document.getElementById("permissionId").value = permission.id
      document.getElementById("permissionName").value = permission.name
      document.getElementById("permissionDescription").value = permission.description
      document.getElementById("permissionCategory").value = permission.category
  
      // Check roles
      permission.roles.forEach((role) => {
        const checkbox = document.getElementById(`role_${role}`)
        if (checkbox) checkbox.checked = true
      })
  
      currentEditingId = permissionId
    } else {
      document.getElementById("permissionModalTitle").textContent = "Add New Permission"
      form.reset()
      currentEditingId = null
    }
  
    currentEditingType = "permission"
    modal.show()
  }
  
  function editPermission(permissionId) {
    openPermissionModal(permissionId)
  }
  
  function deletePermission(permissionId) {
    if (confirm("Are you sure you want to delete this permission?")) {
      dashboardData.permissions = dashboardData.permissions.filter((permission) => permission.id !== permissionId)
      loadPermissionsTable()
      showNotification("Permission deleted successfully", "success")
    }
  }
  
  function savePermission() {
    const form = document.getElementById("permissionForm")
    if (!form.checkValidity()) {
      form.reportValidity()
      return
    }
  
    const selectedRoles = Array.from(document.querySelectorAll("#permissionRoles input:checked")).map(
      (checkbox) => checkbox.value,
    )
  
    const permissionData = {
      name: document.getElementById("permissionName").value,
      description: document.getElementById("permissionDescription").value,
      category: document.getElementById("permissionCategory").value,
      roles: selectedRoles,
    }
  
    if (currentEditingId) {
      // Update existing permission
      const permissionIndex = dashboardData.permissions.findIndex((p) => p.id === currentEditingId)
      dashboardData.permissions[permissionIndex] = { ...dashboardData.permissions[permissionIndex], ...permissionData }
      showNotification("Permission updated successfully", "success")
    } else {
      // Add new permission
      const newPermission = {
        id: Math.max(...dashboardData.permissions.map((p) => p.id)) + 1,
        ...permissionData,
      }
      dashboardData.permissions.push(newPermission)
      showNotification("Permission created successfully", "success")
    }
  
    loadPermissionsTable()
    bootstrap.Modal.getInstance(document.getElementById("permissionModal")).hide()
  }
  
  // Appointments Functions
  function loadAppointmentsTable() {
    const tbody = document.getElementById("appointmentsTableBody")
    tbody.innerHTML = dashboardData.appointments
      .map(
        (appointment) => `
          <tr>
              <td>
                  <div>
                      <strong>${appointment.title}</strong>
                      ${appointment.notes ? `<div><small class="text-muted">${appointment.notes}</small></div>` : ""}
                  </div>
              </td>
              <td>
                  <div class="d-flex align-items-center">
                      <div class="avatar bg-info me-2">${appointment.client.charAt(0)}</div>
                      ${appointment.client}
                  </div>
              </td>
              <td>
                  <div>
                      <div>${appointment.date}</div>
                      <small class="text-muted">${appointment.time}</small>
                  </div>
              </td>
              <td>${appointment.duration} min</td>
              <td><span class="badge bg-light text-dark">${appointment.type}</span></td>
              <td><span class="badge status-${appointment.status.toLowerCase()}">${appointment.status}</span></td>
              <td>
                  <div class="btn-group btn-group-sm">
                      <button class="btn btn-outline-primary" onclick="editAppointment(${appointment.id})">
                          <i class="bi bi-pencil"></i>
                      </button>
                      <button class="btn btn-outline-success" onclick="markCompleted(${appointment.id})" title="Mark as Completed">
                          <i class="bi bi-check-circle"></i>
                      </button>
                      <button class="btn btn-outline-danger" onclick="deleteAppointment(${appointment.id})">
                          <i class="bi bi-trash"></i>
                      </button>
                  </div>
              </td>
          </tr>
      `,
      )
      .join("")
  
    // Update appointment stats
    updateAppointmentStats()
  }
  
  function updateAppointmentStats() {
    const today = new Date().toISOString().split("T")[0]
    const todayAppointments = dashboardData.appointments.filter((apt) => apt.date === today)
    const confirmed = dashboardData.appointments.filter((apt) => apt.status === "Confirmed")
    const pending = dashboardData.appointments.filter((apt) => apt.status === "Scheduled")
    const cancelled = dashboardData.appointments.filter((apt) => apt.status === "Cancelled")
  
    document.getElementById("todayAppointmentsCount").textContent = todayAppointments.length
    document.getElementById("confirmedAppointments").textContent = confirmed.length
    document.getElementById("pendingAppointments").textContent = pending.length
    document.getElementById("cancelledAppointments").textContent = cancelled.length
  }
  
  function openAppointmentModal(appointmentId = null) {
    const modal = new bootstrap.Modal(document.getElementById("appointmentModal"))
    const form = document.getElementById("appointmentForm")
  
    if (appointmentId) {
      const appointment = dashboardData.appointments.find((a) => a.id === appointmentId)
      document.getElementById("appointmentModalTitle").textContent = "Edit Appointment"
      document.getElementById("appointmentId").value = appointment.id
      document.getElementById("appointmentTitle").value = appointment.title
      document.getElementById("appointmentClient").value = appointment.client
      document.getElementById("appointmentDate").value = appointment.date
      document.getElementById("appointmentTime").value = appointment.time
      document.getElementById("appointmentDuration").value = appointment.duration
      document.getElementById("appointmentType").value = appointment.type
      document.getElementById("appointmentStatus").value = appointment.status
      document.getElementById("appointmentNotes").value = appointment.notes || ""
      currentEditingId = appointmentId
    } else {
      document.getElementById("appointmentModalTitle").textContent = "Schedule New Appointment"
      form.reset()
      document.getElementById("appointmentDuration").value = 60
      document.getElementById("appointmentStatus").value = "Scheduled"
      currentEditingId = null
    }
  
    currentEditingType = "appointment"
    modal.show()
  }
  
  function editAppointment(appointmentId) {
    openAppointmentModal(appointmentId)
  }
  
  function deleteAppointment(appointmentId) {
    if (confirm("Are you sure you want to delete this appointment?")) {
      dashboardData.appointments = dashboardData.appointments.filter((appointment) => appointment.id !== appointmentId)
      loadAppointmentsTable()
      showNotification("Appointment deleted successfully", "success")
    }
  }
  
  function markCompleted(appointmentId) {
    const appointmentIndex = dashboardData.appointments.findIndex((a) => a.id === appointmentId)
    dashboardData.appointments[appointmentIndex].status = "Completed"
    loadAppointmentsTable()
    showNotification("Appointment marked as completed", "success")
  }
  
  function saveAppointment() {
    const form = document.getElementById("appointmentForm")
    if (!form.checkValidity()) {
      form.reportValidity()
      return
    }
  
    const appointmentData = {
      title: document.getElementById("appointmentTitle").value,
      client: document.getElementById("appointmentClient").value,
      date: document.getElementById("appointmentDate").value,
      time: document.getElementById("appointmentTime").value,
      duration: Number.parseInt(document.getElementById("appointmentDuration").value),
      type: document.getElementById("appointmentType").value,
      status: document.getElementById("appointmentStatus").value,
      notes: document.getElementById("appointmentNotes").value,
    }
  
    if (currentEditingId) {
      // Update existing appointment
      const appointmentIndex = dashboardData.appointments.findIndex((a) => a.id === currentEditingId)
      dashboardData.appointments[appointmentIndex] = {
        ...dashboardData.appointments[appointmentIndex],
        ...appointmentData,
      }
      showNotification("Appointment updated successfully", "success")
    } else {
      // Add new appointment
      const newAppointment = {
        id: Math.max(...dashboardData.appointments.map((a) => a.id)) + 1,
        ...appointmentData,
      }
      dashboardData.appointments.push(newAppointment)
      showNotification("Appointment scheduled successfully", "success")
    }
  
    loadAppointmentsTable()
    updateDashboardStats()
    bootstrap.Modal.getInstance(document.getElementById("appointmentModal")).hide()
  }
  
  function searchAppointments() {
    const searchTerm = document.getElementById("appointmentSearch").value.toLowerCase()
    const statusFilter = document.getElementById("appointmentStatusFilter").value
  
    let filteredAppointments = dashboardData.appointments.filter(
      (appointment) =>
        appointment.title.toLowerCase().includes(searchTerm) || appointment.client.toLowerCase().includes(searchTerm),
    )
  
    if (statusFilter) {
      filteredAppointments = filteredAppointments.filter((appointment) => appointment.status === statusFilter)
    }
  
    const tbody = document.getElementById("appointmentsTableBody")
    tbody.innerHTML = filteredAppointments
      .map(
        (appointment) => `
          <tr>
              <td>
                  <div>
                      <strong>${appointment.title}</strong>
                      ${appointment.notes ? `<div><small class="text-muted">${appointment.notes}</small></div>` : ""}
                  </div>
              </td>
              <td>
                  <div class="d-flex align-items-center">
                      <div class="avatar bg-info me-2">${appointment.client.charAt(0)}</div>
                      ${appointment.client}
                  </div>
              </td>
              <td>
                  <div>
                      <div>${appointment.date}</div>
                      <small class="text-muted">${appointment.time}</small>
                  </div>
              </td>
              <td>${appointment.duration} min</td>
              <td><span class="badge bg-light text-dark">${appointment.type}</span></td>
              <td><span class="badge status-${appointment.status.toLowerCase()}">${appointment.status}</span></td>
              <td>
                  <div class="btn-group btn-group-sm">
                      <button class="btn btn-outline-primary" onclick="editAppointment(${appointment.id})">
                          <i class="bi bi-pencil"></i>
                      </button>
                      <button class="btn btn-outline-success" onclick="markCompleted(${appointment.id})" title="Mark as Completed">
                          <i class="bi bi-check-circle"></i>
                      </button>
                      <button class="btn btn-outline-danger" onclick="deleteAppointment(${appointment.id})">
                          <i class="bi bi-trash"></i>
                      </button>
                  </div>
              </td>
          </tr>
      `,
      )
      .join("")
  }
  
  // Utility Functions
  function showNotification(message, type = "info") {
    // Create notification element
    const notification = document.createElement("div")
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`
    notification.style.cssText = "top: 20px; right: 20px; z-index: 9999; min-width: 300px;"
    notification.innerHTML = `
          ${message}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      `
  
    document.body.appendChild(notification)
  
    // Auto remove after 5 seconds
    setTimeout(() => {
      if (notification.parentNode) {
        notification.remove()
      }
    }, 5000)
  }
  
  function generateId() {
    return Math.floor(Math.random() * 1000000)
  }
  
  // Event listeners for search and filter
  document.addEventListener("DOMContentLoaded", () => {
    // Add event listener for appointment status filter
    const statusFilter = document.getElementById("appointmentStatusFilter")
    if (statusFilter) {
      statusFilter.addEventListener("change", searchAppointments)
    }
  
    // Add event listeners for search inputs
    const userSearch = document.getElementById("userSearch")
    if (userSearch) {
      userSearch.addEventListener("input", searchUsers)
    }
  
    const appointmentSearch = document.getElementById("appointmentSearch")
    if (appointmentSearch) {
      appointmentSearch.addEventListener("input", searchAppointments)
    }
  })
  
  // Initialize tooltips
  document.addEventListener("DOMContentLoaded", () => {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map((tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl))
  })
  