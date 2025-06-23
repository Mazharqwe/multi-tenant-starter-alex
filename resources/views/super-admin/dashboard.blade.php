@extends('layouts.super-admin')

@section('title', 'Dashboard Overview')

@section('content')
    <!-- Overview Section -->
    <div id="overview" class="section active">
        @include('super-admin.sections.overview')
    </div>

    <!-- Tenants Section -->
    <div id="tenants" class="section">
        @include('super-admin.sections.tenants')
    </div>

    <!-- Add Tenant Section -->
    <div id="tenant-create" class="section">
        @include('super-admin.sections.tenant-create')
    </div>

    <!-- System Settings Section -->
    <div id="settings" class="section">
        @include('super-admin.sections.settings')
    </div>

    <!-- Other sections -->
    <div id="analytics" class="section">
        @include('super-admin.sections.analytics')
    </div>

    <div id="subscriptions" class="section">
        @include('super-admin.sections.subscriptions')
    </div>

    <div id="users" class="section">
        @include('super-admin.sections.users')
    </div>

    <div id="logs" class="section">
        @include('super-admin.sections.logs')
    </div>

    <div id="reports" class="section">
        @include('super-admin.sections.reports')
    </div>

    <div id="billing" class="section">
        @include('super-admin.sections.billing')
    </div>
@endsection

@push('styles')
<style>
    .section {
        display: none;
    }

    .section.active {
        display: block;
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize Charts
    document.addEventListener('DOMContentLoaded', function() {
        // Tenant Growth Chart
        const tenantGrowthCtx = document.getElementById('tenantGrowthChart');
        if (tenantGrowthCtx) {
            new Chart(tenantGrowthCtx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: @json($chartData['labels']),
                    datasets: [{
                        label: 'New Tenants',
                        data: @json($chartData['tenant_growth']),
                        borderColor: '#3498db',
                        backgroundColor: 'rgba(52, 152, 219, 0.1)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Active Tenants',
                        data: @json($chartData['active_tenants']),
                        borderColor: '#27ae60',
                        backgroundColor: 'rgba(39, 174, 96, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Subscription Plans Chart
        const subscriptionCtx = document.getElementById('subscriptionChart');
        if (subscriptionCtx) {
            new Chart(subscriptionCtx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: Object.keys(@json($chartData['subscription_plans'])),
                    datasets: [{
                        data: Object.values(@json($chartData['subscription_plans'])),
                        backgroundColor: ['#95a5a6', '#3498db', '#2c3e50', '#f39c12'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    }
                }
            });
        }
    });

    // Simulate real-time updates
    setInterval(function() {
        updateDashboardStats();
    }, 30000); // Update every 30 seconds
</script>
@endpush
