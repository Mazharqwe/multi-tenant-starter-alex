<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TenantFlow - Multi-Tenant Appointment Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="landing-styles.css" rel="stylesheet">
    <style>
        /* Landing Page Styles */
:root {
  --primary-color: #667eea;
  --secondary-color: #764ba2;
  --accent-color: #f093fb;
  --dark-color: #2d3748;
  --light-color: #f7fafc;
  --success-color: #48bb78;
  --warning-color: #ed8936;
  --danger-color: #f56565;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  line-height: 1.6;
  color: var(--dark-color);
}

/* Smooth scrolling */
html {
  scroll-behavior: smooth;
}

/* Navigation */
.navbar {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  transition: all 0.3s ease;
  box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
}

.navbar-brand {
  font-size: 1.5rem;
  color: var(--dark-color) !important;
}

.nav-link {
  font-weight: 500;
  color: var(--dark-color) !important;
  transition: color 0.3s ease;
}

.nav-link:hover {
  color: var(--primary-color) !important;
}

/* Hero Section */
.hero-section {
  background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
  position: relative;
  overflow: hidden;
  min-height: 100vh;
  display: flex;
  align-items: center;
}

.hero-background {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
  animation: float 20s ease-in-out infinite;
}

@keyframes float {
  0%,
  100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-20px);
  }
}

.hero-content {
  color: white;
  z-index: 2;
  position: relative;
}

.hero-content h1 {
  animation: slideInUp 0.8s ease-out;
}

.hero-content p {
  animation: slideInUp 0.8s ease-out 0.2s both;
}

.hero-stats {
  animation: slideInUp 0.8s ease-out 0.4s both;
}

.hero-actions {
  animation: slideInUp 0.8s ease-out 0.6s both;
}

.hero-badges {
  animation: slideInUp 0.8s ease-out 0.8s both;
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

.stat-item h3 {
  font-size: 2rem;
}

.hero-image {
  animation: slideInRight 0.8s ease-out 0.4s both;
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

/* Dashboard Preview */
.dashboard-preview {
  position: relative;
  transform: perspective(1000px) rotateY(-15deg) rotateX(10deg);
  transition: transform 0.3s ease;
}

.dashboard-preview:hover {
  transform: perspective(1000px) rotateY(-10deg) rotateX(5deg);
}

.browser-mockup {
  background: white;
  border-radius: 10px;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
  overflow: hidden;
}

.browser-header {
  background: #f1f3f4;
  padding: 12px 16px;
  display: flex;
  align-items: center;
  border-bottom: 1px solid #e0e0e0;
}

.browser-buttons {
  display: flex;
  gap: 8px;
  margin-right: 16px;
}

.btn-close-mockup,
.btn-minimize-mockup,
.btn-maximize-mockup {
  width: 12px;
  height: 12px;
  border-radius: 50%;
}

.btn-close-mockup {
  background: #ff5f57;
}

.btn-minimize-mockup {
  background: #ffbd2e;
}

.btn-maximize-mockup {
  background: #28ca42;
}

.browser-url {
  background: white;
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 0.875rem;
  color: #666;
  flex: 1;
}

.browser-content {
  padding: 0;
}

/* Feature Cards */
.feature-card {
  background: white;
  padding: 2rem;
  border-radius: 1rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  border: 1px solid #e2e8f0;
}

.feature-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
}

.feature-icon {
  width: 60px;
  height: 60px;
  background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
  border-radius: 1rem;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.5rem;
}

.feature-icon i {
  font-size: 1.5rem;
  color: white;
}

.feature-card h4 {
  margin-bottom: 1rem;
  color: var(--dark-color);
}

.feature-list {
  list-style: none;
  padding: 0;
  margin-top: 1rem;
}

.feature-list li {
  padding: 0.25rem 0;
  color: #666;
  position: relative;
  padding-left: 1.5rem;
}

.feature-list li::before {
  content: "✓";
  position: absolute;
  left: 0;
  color: var(--success-color);
  font-weight: bold;
}

/* Demo Section */
.demo-video {
  position: relative;
}

.video-placeholder {
  position: relative;
  cursor: pointer;
  border-radius: 1rem;
  overflow: hidden;
  transition: transform 0.3s ease;
}

.video-placeholder:hover {
  transform: scale(1.02);
}

.play-button {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 80px;
  height: 80px;
  background: rgba(255, 255, 255, 0.9);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.play-button:hover {
  background: white;
  transform: translate(-50%, -50%) scale(1.1);
}

.play-button i {
  font-size: 2rem;
  color: var(--primary-color);
  margin-left: 4px;
}

.demo-feature {
  font-size: 1.1rem;
}

/* Pricing Cards */
.pricing-card {
  background: white;
  border-radius: 1rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.pricing-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
}

.pricing-card.featured {
  border: 2px solid var(--primary-color);
  transform: scale(1.05);
}

.pricing-card.featured:hover {
  transform: scale(1.05) translateY(-5px);
}

.popular-badge {
  position: absolute;
  top: 1rem;
  right: -2rem;
  background: var(--primary-color);
  color: white;
  padding: 0.5rem 3rem;
  font-size: 0.875rem;
  font-weight: 600;
  transform: rotate(45deg);
}

.pricing-header {
  text-align: center;
  padding: 2rem 2rem 1rem;
}

.pricing-header h4 {
  margin-bottom: 1rem;
  color: var(--dark-color);
}

.price {
  margin-bottom: 1rem;
}

.currency {
  font-size: 1.5rem;
  vertical-align: top;
  color: var(--primary-color);
}

.amount {
  font-size: 3rem;
  font-weight: bold;
  color: var(--primary-color);
}

.period {
  font-size: 1rem;
  color: #666;
}

.pricing-features {
  padding: 0 2rem;
}

.pricing-features ul {
  list-style: none;
  padding: 0;
}

.pricing-features li {
  padding: 0.75rem 0;
  border-bottom: 1px solid #f1f3f4;
}

.pricing-features li:last-child {
  border-bottom: none;
}

.pricing-footer {
  padding: 1rem 2rem 2rem;
}

/* Testimonial Cards */
.testimonial-card {
  background: white;
  padding: 2rem;
  border-radius: 1rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  height: 100%;
}

.testimonial-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
}

.testimonial-author {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.author-avatar {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
}

/* CTA Section */
.cta-section {
  background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
  position: relative;
  overflow: hidden;
}

.cta-section::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="20" cy="80" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="80" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
  animation: float 15s ease-in-out infinite;
}

/* Contact Cards */
.contact-card {
  background: white;
  padding: 2rem;
  border-radius: 1rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

.contact-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
}

.contact-icon {
  width: 60px;
  height: 60px;
  background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
  border-radius: 1rem;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 1.5rem;
}

.contact-icon i {
  font-size: 1.5rem;
  color: white;
}

/* Buttons */
.btn-primary {
  background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
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

.btn-outline-primary {
  border: 2px solid var(--primary-color);
  color: var(--primary-color);
  border-radius: 0.5rem;
  padding: 0.75rem 1.5rem;
  font-weight: 600;
  transition: all 0.3s ease;
}

.btn-outline-primary:hover {
  background: var(--primary-color);
  border-color: var(--primary-color);
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.btn-lg {
  padding: 1rem 2rem;
  font-size: 1.1rem;
}

/* Footer */
footer {
  background: var(--dark-color) !important;
}

.footer-brand h5 {
  color: white;
}

.social-links a {
  font-size: 1.25rem;
  transition: color 0.3s ease;
}

.social-links a:hover {
  color: var(--primary-color) !important;
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

/* Animations */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.fade-in-up {
  animation: fadeInUp 0.6s ease-out;
}

/* Responsive Design */
@media (max-width: 991.98px) {
  .hero-section {
    text-align: center;
  }

  .dashboard-preview {
    transform: none;
    margin-top: 3rem;
  }

  .pricing-card.featured {
    transform: none;
    margin-top: 2rem;
  }

  .pricing-card.featured:hover {
    transform: translateY(-5px);
  }
}

@media (max-width: 767.98px) {
  .hero-content h1 {
    font-size: 2.5rem;
  }

  .hero-actions {
    flex-direction: column;
    gap: 1rem;
  }

  .hero-actions .btn {
    width: 100%;
  }

  .feature-card,
  .pricing-card,
  .testimonial-card,
  .contact-card {
    margin-bottom: 2rem;
  }
}

/* Loading States */
.loading {
  display: inline-block;
  width: 20px;
  height: 20px;
  border: 3px solid rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  border-top-color: #fff;
  animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

/* Scroll Animations */
.scroll-animate {
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.6s ease-out;
}

.scroll-animate.animate {
  opacity: 1;
  transform: translateY(0);
}

/* Success/Error Messages */
.alert-success {
  background: linear-gradient(135deg, rgba(72, 187, 120, 0.1) 0%, rgba(72, 187, 120, 0.05) 100%);
  border: 1px solid rgba(72, 187, 120, 0.2);
  color: #2f855a;
}

.alert-danger {
  background: linear-gradient(135deg, rgba(245, 101, 101, 0.1) 0%, rgba(245, 101, 101, 0.05) 100%);
  border: 1px solid rgba(245, 101, 101, 0.2);
  color: #c53030;
}

/* Print Styles */
@media print {
  .navbar,
  .cta-section,
  footer {
    display: none !important;
  }

  .hero-section {
    background: white !important;
    color: black !important;
  }

  .feature-card,
  .pricing-card,
  .testimonial-card {
    box-shadow: none !important;
    border: 1px solid #ccc !important;
  }
}
</style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-calendar-check-fill text-primary me-2"></i>
                TenantFlow
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                
                <div class="d-flex">
                    <a href="{{route('login')}}" class="btn btn-outline-primary me-2">Sign In</a>
                    <a href="{{route('register')}}" class="btn btn-primary" onclick="startFreeTrial()">Start Free Trial</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background"></div>
        <div class="container">
            <div class="row align-items-center min-vh-100 py-5">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="display-4 fw-bold mb-4">
                            Streamline Your 
                            <span class="text-primary">Appointment Management</span>
                            Across Multiple Tenants
                        </h1>
                        <p class="lead mb-4">
                            Powerful multi-tenant platform that helps businesses manage appointments, 
                            users, and permissions with enterprise-grade security and scalability.
                        </p>
                        
                        <div class="hero-stats mb-4">
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h3 class="fw-bold text-primary mb-0">10K+</h3>
                                        <small class="text-muted">Active Users</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h3 class="fw-bold text-primary mb-0">500+</h3>
                                        <small class="text-muted">Organizations</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h3 class="fw-bold text-primary mb-0">99.9%</h3>
                                        <small class="text-muted">Uptime</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="hero-actions">
                            <a href="#" class="btn btn-primary btn-lg me-3" onclick="startFreeTrial()">
                                <i class="bi bi-rocket-takeoff me-2"></i>
                                Start Free Trial
                            </a>
                            <a href="#demo" class="btn btn-outline-secondary btn-lg">
                                <i class="bi bi-play-circle me-2"></i>
                                Watch Demo
                            </a>
                        </div>
                        
                        <div class="hero-badges mt-4">
                            <span class="badge bg-light text-dark me-2">
                                <i class="bi bi-shield-check text-success me-1"></i>
                                SOC 2 Compliant
                            </span>
                            <span class="badge bg-light text-dark me-2">
                                <i class="bi bi-lock text-primary me-1"></i>
                                GDPR Ready
                            </span>
                            <span class="badge bg-light text-dark">
                                <i class="bi bi-cloud-check text-info me-1"></i>
                                99.9% Uptime
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="hero-image">
                        <div class="dashboard-preview">
                            <div class="browser-mockup">
                                <div class="browser-header">
                                    <div class="browser-buttons">
                                        <span class="btn-close-mockup"></span>
                                        <span class="btn-minimize-mockup"></span>
                                        <span class="btn-maximize-mockup"></span>
                                    </div>
                                    <div class="browser-url">tenantflow.com/dashboard</div>
                                </div>
                                <div class="browser-content">
                                    <img src="/placeholder.svg?height=400&width=600" alt="Dashboard Preview" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <h2 class="display-5 fw-bold mb-3">Everything You Need to Manage Appointments</h2>
                    <p class="lead text-muted">
                        Comprehensive features designed for modern businesses with multiple locations, 
                        departments, or client bases.
                    </p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100">
                        <div class="feature-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <h4>Multi-Tenant Architecture</h4>
                        <p class="text-muted">
                            Isolated environments for each organization with complete data separation 
                            and customizable branding.
                        </p>
                        <ul class="feature-list">
                            <li>Complete data isolation</li>
                            <li>Custom branding per tenant</li>
                            <li>Scalable infrastructure</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100">
                        <div class="feature-icon">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <h4>Smart Scheduling</h4>
                        <p class="text-muted">
                            Intelligent appointment scheduling with conflict detection, 
                            automated reminders, and calendar integration.
                        </p>
                        <ul class="feature-list">
                            <li>Conflict detection</li>
                            <li>Automated reminders</li>
                            <li>Calendar sync</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100">
                        <div class="feature-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h4>User Management</h4>
                        <p class="text-muted">
                            Comprehensive user management with role-based access control, 
                            permissions, and team collaboration tools.
                        </p>
                        <ul class="feature-list">
                            <li>Role-based access</li>
                            <li>Team collaboration</li>
                            <li>Permission management</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h4>Analytics & Reporting</h4>
                        <p class="text-muted">
                            Real-time analytics and comprehensive reporting to track 
                            performance and optimize operations.
                        </p>
                        <ul class="feature-list">
                            <li>Real-time dashboards</li>
                            <li>Custom reports</li>
                            <li>Performance metrics</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4>Enterprise Security</h4>
                        <p class="text-muted">
                            Bank-level security with encryption, audit logs, 
                            and compliance with industry standards.
                        </p>
                        <ul class="feature-list">
                            <li>End-to-end encryption</li>
                            <li>Audit trails</li>
                            <li>Compliance ready</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100">
                        <div class="feature-icon">
                            <i class="bi bi-phone"></i>
                        </div>
                        <h4>Mobile Ready</h4>
                        <p class="text-muted">
                            Responsive design and mobile apps for iOS and Android 
                            to manage appointments on the go.
                        </p>
                        <ul class="feature-list">
                            <li>Responsive web app</li>
                            <li>iOS & Android apps</li>
                            <li>Offline capabilities</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Demo Section -->
    <section id="demo" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bold mb-4">See TenantFlow in Action</h2>
                    <p class="lead mb-4">
                        Watch how easy it is to set up and manage appointments 
                        across multiple tenants with our intuitive interface.
                    </p>
                    
                    <div class="demo-features">
                        <div class="demo-feature mb-3">
                            <i class="bi bi-check-circle-fill text-success me-3"></i>
                            <span>Quick tenant setup in under 5 minutes</span>
                        </div>
                        <div class="demo-feature mb-3">
                            <i class="bi bi-check-circle-fill text-success me-3"></i>
                            <span>Intuitive appointment scheduling</span>
                        </div>
                        <div class="demo-feature mb-3">
                            <i class="bi bi-check-circle-fill text-success me-3"></i>
                            <span>Real-time collaboration tools</span>
                        </div>
                        <div class="demo-feature mb-3">
                            <i class="bi bi-check-circle-fill text-success me-3"></i>
                            <span>Comprehensive reporting dashboard</span>
                        </div>
                    </div>
                    
                    <a href="login.html" class="btn btn-primary btn-lg">
                        Try Live Demo
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
                
                <div class="col-lg-6">
                    <div class="demo-video">
                        <div class="video-placeholder" onclick="playDemo()">
                            <div class="play-button">
                                <i class="bi bi-play-fill"></i>
                            </div>
                            <img src="/placeholder.svg?height=350&width=500" alt="Demo Video" class="img-fluid rounded">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <h2 class="display-5 fw-bold mb-3">Simple, Transparent Pricing</h2>
                    <p class="lead text-muted">
                        Choose the plan that fits your organization's needs. 
                        All plans include core features with no hidden fees.
                    </p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="pricing-card">
                        <div class="pricing-header">
                            <h4>Starter</h4>
                            <div class="price">
                                <span class="currency">$</span>
                                <span class="amount">29</span>
                                <span class="period">/month</span>
                            </div>
                            <p class="text-muted">Perfect for small teams</p>
                        </div>
                        
                        <div class="pricing-features">
                            <ul>
                                <li><i class="bi bi-check text-success me-2"></i>Up to 3 tenants</li>
                                <li><i class="bi bi-check text-success me-2"></i>100 appointments/month</li>
                                <li><i class="bi bi-check text-success me-2"></i>Basic reporting</li>
                                <li><i class="bi bi-check text-success me-2"></i>Email support</li>
                                <li><i class="bi bi-check text-success me-2"></i>Mobile app access</li>
                            </ul>
                        </div>
                        
                        <div class="pricing-footer">
                            <a href="#" class="btn btn-outline-primary w-100" onclick="selectPlan('starter')">
                                Start Free Trial
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="pricing-card featured">
                        <div class="popular-badge">Most Popular</div>
                        <div class="pricing-header">
                            <h4>Professional</h4>
                            <div class="price">
                                <span class="currency">$</span>
                                <span class="amount">79</span>
                                <span class="period">/month</span>
                            </div>
                            <p class="text-muted">For growing businesses</p>
                        </div>
                        
                        <div class="pricing-features">
                            <ul>
                                <li><i class="bi bi-check text-success me-2"></i>Up to 10 tenants</li>
                                <li><i class="bi bi-check text-success me-2"></i>Unlimited appointments</li>
                                <li><i class="bi bi-check text-success me-2"></i>Advanced analytics</li>
                                <li><i class="bi bi-check text-success me-2"></i>Priority support</li>
                                <li><i class="bi bi-check text-success me-2"></i>API access</li>
                                <li><i class="bi bi-check text-success me-2"></i>Custom branding</li>
                            </ul>
                        </div>
                        
                        <div class="pricing-footer">
                            <a href="#" class="btn btn-primary w-100" onclick="selectPlan('professional')">
                                Start Free Trial
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="pricing-card">
                        <div class="pricing-header">
                            <h4>Enterprise</h4>
                            <div class="price">
                                <span class="currency">$</span>
                                <span class="amount">199</span>
                                <span class="period">/month</span>
                            </div>
                            <p class="text-muted">For large organizations</p>
                        </div>
                        
                        <div class="pricing-features">
                            <ul>
                                <li><i class="bi bi-check text-success me-2"></i>Unlimited tenants</li>
                                <li><i class="bi bi-check text-success me-2"></i>Unlimited everything</li>
                                <li><i class="bi bi-check text-success me-2"></i>White-label solution</li>
                                <li><i class="bi bi-check text-success me-2"></i>24/7 phone support</li>
                                <li><i class="bi bi-check text-success me-2"></i>SSO integration</li>
                                <li><i class="bi bi-check text-success me-2"></i>Dedicated account manager</li>
                            </ul>
                        </div>
                        
                        <div class="pricing-footer">
                            <a href="#" class="btn btn-outline-primary w-100" onclick="contactSales()">
                                Contact Sales
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <p class="text-muted">
                    All plans include a 14-day free trial. No credit card required.
                    <a href="#" class="text-decoration-none">View detailed comparison</a>
                </p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <h2 class="display-5 fw-bold mb-3">Trusted by Thousands of Organizations</h2>
                    <p class="lead text-muted">
                        See what our customers have to say about TenantFlow
                    </p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="stars mb-3">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </div>
                            <p class="mb-4">
                                "TenantFlow has revolutionized how we manage appointments across our 15 locations. 
                                The multi-tenant architecture is exactly what we needed."
                            </p>
                        </div>
                        <div class="testimonial-author">
                            <img src="/placeholder.svg?height=50&width=50" alt="Sarah Johnson" class="author-avatar">
                            <div>
                                <h6 class="mb-0">Sarah Johnson</h6>
                                <small class="text-muted">Operations Director, HealthCare Plus</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="stars mb-3">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </div>
                            <p class="mb-4">
                                "The reporting features are incredible. We can now track performance 
                                across all our departments and make data-driven decisions."
                            </p>
                        </div>
                        <div class="testimonial-author">
                            <img src="/placeholder.svg?height=50&width=50" alt="Michael Chen" class="author-avatar">
                            <div>
                                <h6 class="mb-0">Michael Chen</h6>
                                <small class="text-muted">IT Manager, TechCorp Solutions</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="stars mb-3">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </div>
                            <p class="mb-4">
                                "Setup was incredibly easy, and the support team is fantastic. 
                                We were up and running in less than a day."
                            </p>
                        </div>
                        <div class="testimonial-author">
                            <img src="/placeholder.svg?height=50&width=50" alt="Emily Rodriguez" class="author-avatar">
                            <div>
                                <h6 class="mb-0">Emily Rodriguez</h6>
                                <small class="text-muted">CEO, Wellness Centers Inc.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold text-white mb-4">
                        Ready to Transform Your Appointment Management?
                    </h2>
                    <p class="lead text-white-50 mb-4">
                        Join thousands of organizations already using TenantFlow to streamline 
                        their operations and improve customer experience.
                    </p>
                    
                    <div class="cta-actions">
                        <a href="#" class="btn btn-light btn-lg me-3" onclick="startFreeTrial()">
                            <i class="bi bi-rocket-takeoff me-2"></i>
                            Start Your Free Trial
                        </a>
                        <a href="#contact" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-chat-dots me-2"></i>
                            Talk to Sales
                        </a>
                    </div>
                    
                    <div class="cta-note mt-4">
                        <small class="text-white-50">
                            14-day free trial • No credit card required • Cancel anytime
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <h2 class="display-5 fw-bold mb-3">Get in Touch</h2>
                    <p class="lead text-muted">
                        Have questions? We're here to help you get started.
                    </p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="contact-card text-center">
                        <div class="contact-icon">
                            <i class="bi bi-chat-dots"></i>
                        </div>
                        <h5>Live Chat</h5>
                        <p class="text-muted">Chat with our support team</p>
                        <a href="#" class="btn btn-outline-primary" onclick="openChat()">Start Chat</a>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="contact-card text-center">
                        <div class="contact-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <h5>Email Support</h5>
                        <p class="text-muted">Get help via email</p>
                        <a href="mailto:support@tenantflow.com" class="btn btn-outline-primary">Send Email</a>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="contact-card text-center">
                        <div class="contact-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <h5>Phone Support</h5>
                        <p class="text-muted">Call us directly</p>
                        <a href="tel:+1-555-123-4567" class="btn btn-outline-primary">Call Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-brand">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-calendar-check-fill text-primary me-2"></i>
                            TenantFlow
                        </h5>
                        <p class="text-white-50 mb-4">
                            The leading multi-tenant appointment management system 
                            trusted by thousands of organizations worldwide.
                        </p>
                        <div class="social-links">
                            <a href="#" class="text-white-50 me-3"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="text-white-50 me-3"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="text-white-50 me-3"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="text-white-50"><i class="bi bi-github"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-2">
                    <h6 class="fw-bold mb-3">Product</h6>
                    <ul class="list-unstyled">
                        <li><a href="#features" class="text-white-50 text-decoration-none">Features</a></li>
                        <li><a href="#pricing" class="text-white-50 text-decoration-none">Pricing</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">API Docs</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Integrations</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2">
                    <h6 class="fw-bold mb-3">Company</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 text-decoration-none">About Us</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Careers</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Blog</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Press</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2">
                    <h6 class="fw-bold mb-3">Support</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 text-decoration-none">Help Center</a></li>
                        <li><a href="#contact" class="text-white-50 text-decoration-none">Contact</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Status</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Security</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2">
                    <h6 class="fw-bold mb-3">Legal</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 text-decoration-none">Privacy</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Terms</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Cookies</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">GDPR</a></li>
                    </ul>
                </div>
            </div>
            
            <hr class="my-4 border-secondary">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-white-50 mb-0">
                        © 2024 TenantFlow. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-white-50 mb-0">
                        Made with <i class="bi bi-heart-fill text-danger"></i> for better appointment management
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Free Trial Modal -->
    <div class="modal fade" id="freeTrialModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Start Your Free Trial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="freeTrialForm">
                        <div class="mb-3">
                            <label for="companyName" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="companyName" required>
                        </div>
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" required>
                        </div>
                        <div class="mb-3">
                            <label for="workEmail" class="form-label">Work Email</label>
                            <input type="email" class="form-control" id="workEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phoneNumber">
                        </div>
                        <div class="mb-3">
                            <label for="teamSize" class="form-label">Team Size</label>
                            <select class="form-select" id="teamSize" required>
                                <option value="">Select team size</option>
                                <option value="1-10">1-10 employees</option>
                                <option value="11-50">11-50 employees</option>
                                <option value="51-200">51-200 employees</option>
                                <option value="200+">200+ employees</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="submitFreeTrial()">Start Free Trial</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/landing-script.js')}}"></script>
</body>
</html>
