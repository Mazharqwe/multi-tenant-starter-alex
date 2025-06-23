@extends('tenant.layouts.app')

@section('title', 'Services Management')
@section('page-title', 'Services Management')

@section('content')
<div class="page-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Services Management</h2>
        <button class="btn btn-primary" onclick="openServiceModal()">
            <i class="bi bi-plus-circle me-2"></i>
            Add Service
        </button>
    </div>

    <div class="row" id="servicesContainer">
        @forelse($services as $service)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title mb-0">{{ $service->name }}</h5>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="editService({{ $service->id }})">
                                    <i class="bi bi-pencil me-2"></i>Edit
                                </a></li>
                                <li><a class="dropdown-item" href="#" onclick="deleteService({{ $service->id }})">
                                    <i class="bi bi-trash me-2"></i>Delete
                                </a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <p class="card-text text-muted">{{ $service->description }}</p>
                    
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h6 class="text-primary mb-1">${{ $service->price }}</h6>
                                <small class="text-muted">Price</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h6 class="text-success mb-1">{{ $service->duration }} min</h6>
                            <small class="text-muted">Duration</small>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <span class="badge {{ $service->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $service->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        @if($service->category)
                            <span class="badge bg-info">{{ $service->category }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-gear display-1 text-muted"></i>
                <h4 class="mt-3">No Services Found</h4>
                <p class="text-muted">Get started by adding your first service.</p>
                <button class="btn btn-primary" onclick="openServiceModal()">
                    <i class="bi bi-plus-circle me-2"></i>
                    Add Service
                </button>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Service Modal -->
@include('tenant.components.service-modal')
@endsection

@push('scripts')
<script>
function openServiceModal() {
    $('#serviceModal').modal('show');
}

function editService(serviceId) {
    // Load service data and show modal
    $('#serviceModal').modal('show');
}

function deleteService(serviceId) {
    if (confirm('Are you sure you want to delete this service?')) {
        // Delete service logic
    }
}
</script>
@endpush 