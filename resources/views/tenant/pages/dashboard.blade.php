@extends('tenant.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Dashboard Overview</h2>
        <button class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>
            Quick Action
        </button>
    </div>

    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle p-3 me-3">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">{{ $stats['total_customers'] }}</h5>
                        <p class="card-text text-muted mb-0">Total Customers</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-success text-white rounded-circle p-3 me-3">
                        <i class="bi bi-calendar-check fs-4"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">{{ $stats['total_appointments'] }}</h5>
                        <p class="card-text text-muted mb-0">Total Appointments</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-warning text-white rounded-circle p-3 me-3">
                        <i class="bi bi-person-badge fs-4"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">{{ $stats['total_staff'] }}</h5>
                        <p class="card-text text-muted mb-0">Staff Members</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-info text-white rounded-circle p-3 me-3">
                        <i class="bi bi-gear fs-4"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">{{ $stats['total_services'] }}</h5>
                        <p class="card-text text-muted mb-0">Active Services</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Recent Appointments</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Service</th>
                                    <th>Date & Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recent_appointments as $appointment)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-primary me-2">
                                                {{ strtoupper(substr($appointment->customer->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $appointment->customer->name }}</div>
                                                <small class="text-muted">{{ $appointment->customer->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $appointment->service->name }}</div>
                                        <small class="text-muted">${{ $appointment->service->price }}</small>
                                    </td>
                                    <td>
                                        <div>{{ $appointment->appointment_date->format('M j, Y') }}</div>
                                        <small class="text-muted">{{ $appointment->appointment_time }}</small>
                                    </td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-warning',
                                                'confirmed' => 'bg-success',
                                                'cancelled' => 'bg-danger',
                                                'completed' => 'bg-secondary'
                                            ];
                                            $statusColor = $statusColors[$appointment->status] ?? 'bg-secondary';
                                        @endphp
                                        <span class="badge {{ $statusColor }}">{{ ucfirst($appointment->status) }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No recent appointments</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('appointments.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>
                            New Appointment
                        </a>
                        <a href="{{ route('services.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-gear me-2"></i>
                            Manage Services
                        </a>
                        <a href="{{ route('staff.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-person-badge me-2"></i>
                            Manage Staff
                        </a>
                        <a href="{{ route('users.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-people me-2"></i>
                            View Customers
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 