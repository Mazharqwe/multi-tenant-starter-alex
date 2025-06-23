@extends('tenant.layouts.app')

@section('title', 'Staff Management')
@section('page-title', 'Staff Management')

@section('content')
<div class="page-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Staff Management</h2>
        <button class="btn btn-primary" onclick="openStaffModal()">
            <i class="bi bi-plus-circle me-2"></i>
            Add Staff Member
        </button>
    </div>

    <div class="row" id="staffContainer">
        @forelse($staff as $staffMember)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar bg-primary mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        {{ strtoupper(substr($staffMember->user->name, 0, 1)) }}
                    </div>
                    
                    <h5 class="card-title mb-1">{{ $staffMember->user->name }}</h5>
                    <p class="text-muted mb-2">{{ $staffMember->position }}</p>
                    
                    <div class="mb-3">
                        <span class="badge {{ $staffMember->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $staffMember->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        @if($staffMember->specialization)
                            <span class="badge bg-info">{{ $staffMember->specialization }}</span>
                        @endif
                    </div>
                    
                    <div class="row text-center mb-3">
                        <div class="col-6">
                            <div class="border-end">
                                <h6 class="text-primary mb-1">{{ $staffMember->appointments_count ?? 0 }}</h6>
                                <small class="text-muted">Appointments</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h6 class="text-success mb-1">{{ $staffMember->services_count ?? 0 }}</h6>
                            <small class="text-muted">Services</small>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn btn-sm btn-outline-primary" onclick="editStaff({{ $staffMember->id }})">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-info" onclick="viewStaffSchedule({{ $staffMember->id }})">
                            <i class="bi bi-calendar"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger" onclick="deleteStaff({{ $staffMember->id }})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-person-badge display-1 text-muted"></i>
                <h4 class="mt-3">No Staff Members Found</h4>
                <p class="text-muted">Get started by adding your first staff member.</p>
                <button class="btn btn-primary" onclick="openStaffModal()">
                    <i class="bi bi-plus-circle me-2"></i>
                    Add Staff Member
                </button>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Staff Modal -->
@include('tenant.components.staff-modal')
@endsection

@push('scripts')
<script>
function openStaffModal() {
    $('#staffModal').modal('show');
}

function editStaff(staffId) {
    // Load staff data and show modal
    $('#staffModal').modal('show');
}

function viewStaffSchedule(staffId) {
    // View staff schedule logic
    window.location.href = `/staff/${staffId}/schedule`;
}

function deleteStaff(staffId) {
    if (confirm('Are you sure you want to delete this staff member?')) {
        // Delete staff logic
    }
}
</script>
@endpush 