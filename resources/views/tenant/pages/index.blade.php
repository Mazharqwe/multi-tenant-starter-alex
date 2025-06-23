@extends('tenant.layouts.app')

@section('title', 'Welcome')
@section('page-title', 'Welcome')

@section('content')
<div class="page-content">
    <div class="text-center py-5">
        <h1 class="display-4 mb-4">Welcome to Your Tenant Portal</h1>
        <p class="lead mb-4">Manage your business operations efficiently with our comprehensive dashboard.</p>
        
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-people display-4 text-primary mb-3"></i>
                        <h5>Users</h5>
                        <p class="text-muted">Manage customers and staff</p>
                        <a href="{{ route('users.index') }}" class="btn btn-primary">View Users</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-calendar-event display-4 text-success mb-3"></i>
                        <h5>Appointments</h5>
                        <p class="text-muted">Schedule and manage bookings</p>
                        <a href="{{ route('appointments.index') }}" class="btn btn-success">View Appointments</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-gear display-4 text-warning mb-3"></i>
                        <h5>Services</h5>
                        <p class="text-muted">Manage your service offerings</p>
                        <a href="{{ route('services.index') }}" class="btn btn-warning">View Services</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-person-badge display-4 text-info mb-3"></i>
                        <h5>Staff</h5>
                        <p class="text-muted">Manage your team</p>
                        <a href="{{ route('staff.index') }}" class="btn btn-info">View Staff</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 