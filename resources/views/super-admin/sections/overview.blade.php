<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <x-super-admin.stat-card 
            type="primary" 
            icon="fas fa-building" 
            :number="number_format($stats['total_tenants'])" 
            label="Total Tenants" 
            id="totalTenants" />
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <x-super-admin.stat-card 
            type="success" 
            icon="fas fa-check-circle" 
            :number="number_format($stats['active_tenants'])" 
            label="Active Tenants" 
            id="activeTenants" />
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <x-super-admin.stat-card 
            type="warning" 
            icon="fas fa-dollar-sign" 
            :number="'$' . number_format($stats['monthly_revenue'])" 
            label="Monthly Revenue" 
            id="monthlyRevenue" />
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <x-super-admin.stat-card 
            type="info" 
            icon="fas fa-users" 
            :number="number_format($stats['total_users'])" 
            label="Total Users" 
            id="totalUsers" />
    </div>
</div>

<div class="row">
    <!-- Quick Actions -->
    <div class="col-lg-4 mb-4">
        <div class="quick-actions">
            <h5 class="mb-4">Quick Actions</h5>
            <div class="row">
                <div class="col-6 mb-3">
                    <a href="{{ route('super-admin.tenants.create') }}" class="quick-action-btn">
                        <i class="fas fa-plus"></i>
                        <span>Add Tenant</span>
                    </a>
                </div>
                <div class="col-6 mb-3">
                    <a href="{{ route('super-admin.tenants.index') }}" class="quick-action-btn">
                        <i class="fas fa-building"></i>
                        <span>View Tenants</span>
                    </a>
                </div>
                <div class="col-6 mb-3">
                    <a href="#" class="quick-action-btn">
                        <i class="fas fa-chart-bar"></i>
                        <span>View Reports</span>
                    </a>
                </div>
                <div class="col-6 mb-3">
                    <a href="#" class="quick-action-btn">
                        <i class="fas fa-cogs"></i>
                        <span>Settings</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Recent Activity</h5>
            </div>
            <div class="card-body">
                @forelse($recentActivity as $activity)
                    <x-super-admin.activity-item 
                        :icon="$activity['icon']"
                        :color="$activity['color']"
                        :title="$activity['title']"
                        :description="$activity['description']"
                        :time="$activity['time']" />
                @empty
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <p>No recent activity</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Tenant Growth</h5>
            </div>
            <div class="card-body">
                <canvas id="tenantGrowthChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Subscription Plans</h5>
            </div>
            <div class="card-body">
                <canvas id="subscriptionChart"></canvas>
            </div>
        </div>
    </div>
</div>

<style>
    .quick-actions {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .card-header {
        background: white;
        border-bottom: 1px solid #e9ecef;
        padding: 1.5rem;
        border-radius: 12px 12px 0 0 !important;
    }
</style>
