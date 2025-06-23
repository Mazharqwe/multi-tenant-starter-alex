<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Portal - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="login-styles.css" rel="stylesheet">
    <style>
        /* Login Page Styles */
.login-body {
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  min-height: 100vh;
  margin: 0;
  padding: 0;
}

.login-container {
  min-height: 100vh;
}

.login-brand-side {
  background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%),
    url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="10" cy="50" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="90" cy="30" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
  position: relative;
  overflow: hidden;
}

.login-brand-side::before {
  content: "";
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
  background-size: 50px 50px;
  animation: float 20s ease-in-out infinite;
}

@keyframes float {
  0%,
  100% {
    transform: translate(0, 0) rotate(0deg);
  }
  33% {
    transform: translate(30px, -30px) rotate(120deg);
  }
  66% {
    transform: translate(-20px, 20px) rotate(240deg);
  }
}

.brand-logo {
  animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
  0%,
  100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.05);
  }
}

.features-list {
  max-width: 300px;
}

.feature-item {
  font-size: 1.1rem;
  opacity: 0;
  animation: slideInUp 0.6s ease-out forwards;
}

.feature-item:nth-child(1) {
  animation-delay: 0.2s;
}
.feature-item:nth-child(2) {
  animation-delay: 0.4s;
}
.feature-item:nth-child(3) {
  animation-delay: 0.6s;
}
.feature-item:nth-child(4) {
  animation-delay: 0.8s;
}

@keyframes slideInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.login-form-container {
  width: 100%;
  max-width: 450px;
  padding: 2rem;
}

.card {
  border-radius: 1rem;
  backdrop-filter: blur(10px);
  background: rgba(255, 255, 255, 0.95);
  animation: slideInRight 0.6s ease-out;
}

@keyframes slideInRight {
  from {
    opacity: 0;
    transform: translateX(50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.input-group-text {
  background-color: #f8f9fa;
  border-right: none;
  color: #6c757d;
}

.form-control {
  border-left: none;
  padding-left: 0;
  transition: all 0.3s ease;
}

.form-control:focus {
  box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
  border-color: #667eea;
}

.form-control:focus + .input-group-text,
.input-group-text:has(+ .form-control:focus) {
  border-color: #667eea;
  background-color: rgba(102, 126, 234, 0.1);
}

.btn-primary {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  border: none;
  border-radius: 0.5rem;
  padding: 0.75rem 1.5rem;
  font-weight: 600;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.btn-primary:active {
  transform: translateY(0);
}

.btn-primary::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.5s;
}

.btn-primary:hover::before {
  left: 100%;
}

.btn-outline-secondary {
  border-radius: 50%;
  width: 45px;
  height: 45px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.btn-outline-secondary:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.demo-credentials {
  font-size: 0.875rem;
}

.demo-credentials .btn {
  font-size: 0.75rem;
  padding: 0.25rem 0.5rem;
}

.alert-info {
  background: linear-gradient(135deg, rgba(13, 202, 240, 0.1) 0%, rgba(13, 110, 253, 0.1) 100%);
  border: 1px solid rgba(13, 202, 240, 0.2);
  border-radius: 0.75rem;
}

/* Loading Animation */
.spinner-border-sm {
  width: 1rem;
  height: 1rem;
}

/* Form Validation Styles */
.was-validated .form-control:valid {
  border-color: #198754;
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='m2.3 6.73.94-.94 1.44 1.44L7.4 4.5l.94.94L4.6 9.18z'/%3e%3c/svg%3e");
}

.was-validated .form-control:invalid {
  border-color: #dc3545;
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 4.6 2.4 2.4M8.2 4.6l-2.4 2.4'/%3e%3c/svg%3e");
}

/* Responsive Design */
@media (max-width: 991.98px) {
  .login-form-container {
    padding: 1rem;
  }

  .card-body {
    padding: 2rem !important;
  }
}

@media (max-width: 575.98px) {
  .login-form-container {
    padding: 0.5rem;
  }

  .card-body {
    padding: 1.5rem !important;
  }

  .demo-credentials .row {
    flex-direction: column;
  }

  .demo-credentials .col-md-6 {
    margin-bottom: 1rem;
  }
}

/* Modal Enhancements */
.modal-content {
  border-radius: 1rem;
  border: none;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
}

.modal-header {
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  padding: 1.5rem;
}

.modal-body {
  padding: 1.5rem;
}

.modal-footer {
  border-top: 1px solid rgba(0, 0, 0, 0.1);
  padding: 1.5rem;
}

/* Success/Error Messages */
.alert-success {
  background: linear-gradient(135deg, rgba(25, 135, 84, 0.1) 0%, rgba(25, 135, 84, 0.05) 100%);
  border: 1px solid rgba(25, 135, 84, 0.2);
  color: #0f5132;
}

.alert-danger {
  background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.05) 100%);
  border: 1px solid rgba(220, 53, 69, 0.2);
  color: #842029;
}

/* Accessibility Improvements */
.form-control:focus,
.btn:focus {
  outline: 2px solid rgba(102, 126, 234, 0.5);
  outline-offset: 2px;
}

/* Print Styles */
@media print {
  .login-body {
    background: white !important;
  }

  .login-brand-side {
    display: none !important;
  }

  .card {
    box-shadow: none !important;
    border: 1px solid #ccc !important;
  }
}
</style>
</head>
<body class="login-body">
    <div class="login-container">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <!-- Left Side - Branding -->
                <div class="col-lg-6 d-none d-lg-flex login-brand-side">
                    <div class="d-flex flex-column justify-content-center align-items-center text-white p-5">
                        <div class="brand-logo mb-4">
                            <i class="bi bi-building display-1"></i>
                        </div>
                        <h1 class="display-4 fw-bold mb-3">Tenant Portal</h1>
                        <p class="lead text-center mb-4">
                            Comprehensive management system for users, roles, permissions, and appointments
                        </p>
                        <div class="features-list">
                            <div class="feature-item mb-3">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                User Management System
                            </div>
                            <div class="feature-item mb-3">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                Role-Based Access Control
                            </div>
                            <div class="feature-item mb-3">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                Appointment Scheduling
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                Real-time Dashboard Analytics
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Login Form -->
                <div class="col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="login-form-container">
                        <div class="text-center mb-4 d-lg-none">
                            <i class="bi bi-building display-4 text-primary"></i>
                            <h2 class="mt-2">Tenant Portal</h2>
                        </div>

                        <div class="card shadow-lg border-0">
                            <div class="card-body p-5">
                                <div class="text-center mb-4">
                                    <h3 class="card-title fw-bold">Welcome Back</h3>
                                    <p class="text-muted">Please sign in to your account</p>
                                </div>

                                <!-- Login Form -->
                                <form id="loginForm" novalidate action="{{ route('login') }}" method="POST">
                                    @csrf
                                <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-envelope"></i>
                                            </span>
                                            <input type="email" class="form-control" id="email" name="email" 
                                                   placeholder="Enter your email" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid email address.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" id="password" name="password" 
                                                   placeholder="Enter your password" required>
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="bi bi-eye" id="togglePasswordIcon"></i>
                                            </button>
                                            <div class="invalid-feedback">
                                                Password is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a href="#" class="text-decoration-none" onclick="showForgotPassword()">
                                                Forgot password?
                                            </a>
                                        </div>
                                    </div>

                                    <div class="d-grid mb-3">
                                        <button type="submit" class="btn btn-primary btn-lg" id="loginBtn">
                                            <span id="loginBtnText">Sign In</span>
                                            <span id="loginSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </span>
                                        </button>
                                    </div>

                                   
                                
                                </form>

                                <!-- Social Login Options -->
                                <div class="text-center">
                                    <p class="text-muted mb-3">Or sign in with</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-outline-secondary" onclick="socialLogin('google')">
                                            <i class="bi bi-google"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary" onclick="socialLogin('microsoft')">
                                            <i class="bi bi-microsoft"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary" onclick="socialLogin('github')">
                                            <i class="bi bi-github"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="text-center mt-4">
                            <p class="text-muted">
                                Don't have an account? 
                                <a href="#" class="text-decoration-none" onclick="showRegister()">Sign up here</a>
                            </p>
                            <div class="mt-3">
                                <a href="#" class="text-muted text-decoration-none me-3">Privacy Policy</a>
                                <a href="#" class="text-muted text-decoration-none me-3">Terms of Service</a>
                                <a href="#" class="text-muted text-decoration-none">Support</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">Enter your email address and we'll send you a link to reset your password.</p>
                    <form id="forgotPasswordForm">
                        <div class="mb-3">
                            <label for="resetEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="resetEmail" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="sendResetEmail()">Send Reset Link</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Registration Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="registerForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="registerEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="registerPassword" required>
                            <div class="form-text">Password must be at least 8 characters long.</div>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="organization" class="form-label">Organization</label>
                            <input type="text" class="form-control" id="organization">
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                            <label class="form-check-label" for="agreeTerms">
                                I agree to the <a href="#" class="text-decoration-none">Terms of Service</a> and 
                                <a href="#" class="text-decoration-none">Privacy Policy</a>
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="registerUser()">Create Account</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="login-script.js"></script>
</body>
</html>
