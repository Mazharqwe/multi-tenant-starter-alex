@extends('tenant.layouts.app')

@section('title', 'Appointments Management')
@section('page-title', 'Appointments Management')

@section('content')
<div class="page-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Appointments Management</h2>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary">
                <i class="bi bi-calendar me-2"></i>
                Calendar View
            </button>
            <button class="btn btn-primary" onclick="openAppointmentModal()">
                <i class="bi bi-plus-circle me-2"></i>
                Schedule Appointment
            </button>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $stats['total_appointments'] }}</h5>
                    <p class="card-text">Total Appointments</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-success">{{ $stats['confirmed_appointments'] ?? 0 }}</h5>
                    <p class="card-text">Confirmed</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-warning">{{ $stats['pending_appointments'] }}</h5>
                    <p class="card-text">Pending</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-danger">{{ $stats['cancelled_appointments'] ?? 0 }}</h5>
                    <p class="card-text">Cancelled</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">All Appointments</h5>
                </div>
                <div class="col-auto">
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" id="appointmentStatusFilter">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" placeholder="Search..." id="appointmentSearch">
                            <button class="btn btn-outline-secondary btn-sm" onclick="searchAppointments()">
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
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Staff</th>
                            <th>Date & Time</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="appointmentsTableBody">
                        @forelse($appointments as $appointment)
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
                            <td>{{ $appointment->staff->user->name }}</td>
                            <td>
                                <div>{{ $appointment->appointment_date->format('M j, Y') }}</div>
                                <small class="text-muted">{{ $appointment->appointment_time }}</small>
                            </td>
                            <td>{{ $appointment->service->duration }} min</td>
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
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary" onclick="editAppointment({{ $appointment->id }})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-outline-success" onclick="confirmAppointment({{ $appointment->id }})">
                                        <i class="bi bi-check"></i>
                                    </button>
                                    <button class="btn btn-outline-danger" onclick="cancelAppointment({{ $appointment->id }})">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No appointments found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Appointment Modal -->
@include('tenant.components.appointment-modal')
@endsection

@push('scripts')
<script>
function openAppointmentModal() {
    $('#appointmentModal').modal('show');
}

function editAppointment(appointmentId) {
    // Load appointment data and show modal
    $('#appointmentModal').modal('show');
}

function confirmAppointment(appointmentId) {
    if (confirm('Confirm this appointment?')) {
        // Confirm appointment logic
    }
}

function cancelAppointment(appointmentId) {
    if (confirm('Cancel this appointment?')) {
        // Cancel appointment logic
    }
}

function searchAppointments() {
    const searchTerm = $('#appointmentSearch').val();
    // Implement search logic
}
</script>
@endpush 