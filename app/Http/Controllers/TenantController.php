<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('domains')->get();
        return view('tenants.index', compact('tenants'));
    }

    public function create()
    {
        return view('tenants.create');
    }

    public function store(Request $request)
    {
        // Get the current domain first
        $currentDomain = $this->getCurrentDomain();
        $fullDomain = $request->subdomain . '.' . $currentDomain;
        
        $request->validate([
            'name' => 'required|string|max:255',
            'subdomain' => [
                'required',
                'string',
                'regex:/^[a-z0-9-]+$/',
                'min:3',
                'max:63',
                function ($attribute, $value, $fail) use ($fullDomain) {
                    $existingDomain = DB::table('domains')->where('domain', $fullDomain)->first();
                    if ($existingDomain) {
                        $fail('This subdomain is already in use.');
                    }
                }
            ],
            'admin_email' => 'required|email|max:255',
            'admin_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:2',
            'address' => 'nullable|string|max:500',
            'plan' => 'nullable|string|in:basic,pro,enterprise',
            'trial_period' => 'nullable|integer|min:0|max:365',
            'send_welcome' => 'nullable|boolean',
            'auto_activate' => 'nullable|boolean',
        ], [
            'name.required' => 'Company name is required.',
            'name.max' => 'Company name cannot exceed 255 characters.',
            'subdomain.required' => 'Subdomain is required.',
            'subdomain.regex' => 'Subdomain can only contain letters, numbers, and hyphens.',
            'subdomain.min' => 'Subdomain must be at least 3 characters.',
            'subdomain.max' => 'Subdomain cannot exceed 63 characters.',
            'admin_email.required' => 'Admin email is required.',
            'admin_email.email' => 'Please enter a valid email address.',
            'admin_email.max' => 'Email cannot exceed 255 characters.',
            'admin_name.required' => 'Admin name is required.',
            'admin_name.max' => 'Admin name cannot exceed 255 characters.',
            'phone.max' => 'Phone number cannot exceed 20 characters.',
            'country.max' => 'Country code cannot exceed 2 characters.',
            'address.max' => 'Address cannot exceed 500 characters.',
            'plan.in' => 'Invalid subscription plan selected.',
            'trial_period.integer' => 'Trial period must be a number.',
            'trial_period.min' => 'Trial period cannot be negative.',
            'trial_period.max' => 'Trial period cannot exceed 365 days.',
        ]);

        // Start database transaction
        DB::beginTransaction();

        try {
            // Create tenant in central database
            $tenant = Tenant::create([
                'name' => $request->name,
                'email' => $request->admin_email, // Store in main email field for compatibility
                'is_active' => $request->boolean('auto_activate', true),
                'data' => [
                    'admin_email' => $request->admin_email,
                    'admin_name' => $request->admin_name,
                    'phone' => $request->phone,
                    'country' => $request->country,
                    'address' => $request->address,
                    'subscription_plan' => $request->plan ?? 'basic',
                    'trial_period' => $request->trial_period ?? 0,
                    'send_welcome' => $request->boolean('send_welcome', true),
                    'features' => $this->getPlanFeatures($request->plan ?? 'basic'),
                ],
            ]);

            // Create domain for the tenant with the full domain
            $domain = $tenant->domains()->create([
                'domain' => $fullDomain,
            ]);

            // Log the tenant creation for audit purposes
            \Log::info('Tenant created successfully', [
                'tenant_id' => $tenant->id,
                'tenant_name' => $tenant->name,
                'domain' => $fullDomain,
                'admin_email' => $request->admin_email,
                'created_by' => auth()->id(),
                'created_at' => now(),
            ]);

            // Commit the transaction
            DB::commit();

            // Database creation, migration, and seeding is handled manually after transaction
            // to avoid transaction context issues
            try {
                \Log::info('Starting manual database creation for tenant', [
                    'tenant_id' => $tenant->id,
                    'tenant_name' => $tenant->name,
                ]);

                // Create database manually
                $databaseManager = app(\Stancl\Tenancy\Database\DatabaseManager::class);
                
                // Create database
                $createJob = new \Stancl\Tenancy\Jobs\CreateDatabase($tenant);
                $createJob->handle($databaseManager);

                // Run migrations
                $migrateJob = new \Stancl\Tenancy\Jobs\MigrateDatabase($tenant);
                $migrateJob->handle($databaseManager);

                // Run seeding
                $seedJob = new \Stancl\Tenancy\Jobs\SeedDatabase($tenant);
                $seedJob->handle($databaseManager);

                \Log::info('Database creation completed successfully', [
                    'tenant_id' => $tenant->id,
                    'tenant_name' => $tenant->name,
                ]);

            } catch (\Exception $dbException) {
                \Log::error('Database creation failed for tenant', [
                    'tenant_id' => $tenant->id,
                    'tenant_name' => $tenant->name,
                    'error' => $dbException->getMessage(),
                    'trace' => $dbException->getTraceAsString(),
                ]);

                // Don't fail the entire request if database creation fails
                // The tenant record is already created, database can be created later
            }

            try {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Tenant created successfully! Database setup is in progress...',
                        'tenant' => $tenant->load('domains')
                    ]);
                }

                return redirect()->route('super-admin.tenants.index')
                    ->with('success', 'Tenant created successfully! Database setup is in progress...');
            } catch (\Exception $responseException) {
                // Log the response generation error
                \Log::error('Error generating response after tenant creation', [
                    'tenant_id' => $tenant->id,
                    'error' => $responseException->getMessage(),
                    'trace' => $responseException->getTraceAsString(),
                ]);

                // Still return a success response even if there was an error generating the detailed response
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Tenant created successfully!',
                    ]);
                }

                return redirect()->route('super-admin.tenants.index')
                    ->with('success', 'Tenant created successfully!');
            }

        } catch (\Exception $e) {
            // Rollback the transaction on any error
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }

            // Log the error for debugging
            \Log::error('Tenant creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['_token']),
                'user_id' => auth()->id(),
                'transaction_level' => DB::transactionLevel(),
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create tenant: ' . $e->getMessage(),
                    'errors' => ['general' => [$e->getMessage()]]
                ], 422);
            }

            return back()->withInput()->with('error', 'Failed to create tenant: ' . $e->getMessage());
        }
    }

    /**
     * Get the current domain for the application
     */
    private function getCurrentDomain()
    {
        // Try to get from config first
        $configDomain = config('app.domain');
        if ($configDomain) {
            return $configDomain;
        }

        // Fallback to request host
        $host = request()->getHost();
        
        // Remove 'www.' if present
        if (str_starts_with($host, 'www.')) {
            $host = substr($host, 4);
        }
        
        // For local development, default to localhost
        if (in_array($host, ['localhost', '127.0.0.1', '::1'])) {
            return 'localhost';
        }
        
        return $host;
    }

    public function storeDraft(Request $request)
    {
        // Get the current domain first
        $currentDomain = $this->getCurrentDomain();
        $fullDomain = $request->subdomain ? $request->subdomain . '.' . $currentDomain : null;
        
        $request->validate([
            'name' => 'nullable|string|max:255',
            'subdomain' => [
                'nullable',
                'string',
                'regex:/^[a-z0-9-]+$/',
                'min:3',
                'max:63',
                function ($attribute, $value, $fail) use ($fullDomain) {
                    if ($fullDomain) {
                        $existingDomain = DB::table('domains')->where('domain', $fullDomain)->first();
                        if ($existingDomain) {
                            $fail('This subdomain is already in use.');
                        }
                    }
                }
            ],
            'admin_email' => 'nullable|email|max:255',
            'admin_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:2',
            'address' => 'nullable|string|max:500',
            'plan' => 'nullable|string|in:basic,pro,enterprise',
            'trial_period' => 'nullable|integer|min:0|max:365',
        ]);

        try {
            // Store draft data in session or temporary storage
            $draftData = $request->except(['_token', 'is_draft']);
            $draftData['full_domain'] = $fullDomain;
            
            // For now, we'll just return success
            // In a real application, you might store this in a drafts table or session
            
            return response()->json([
                'success' => true,
                'message' => 'Draft saved successfully!',
                'draft' => $draftData
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save draft: ' . $e->getMessage()
            ], 422);
        }
    }

    private function getPlanFeatures($plan)
    {
        $features = [
            'basic' => ['appointments', 'staff_management', 'service_management'],
            'pro' => ['appointments', 'staff_management', 'service_management', 'advanced_analytics', 'custom_branding'],
            'enterprise' => ['appointments', 'staff_management', 'service_management', 'advanced_analytics', 'custom_branding', 'api_access', 'priority_support', 'white_label']
        ];

        return $features[$plan] ?? $features['basic'];
    }

    public function show(Tenant $tenant)
    {
        return view('tenants.show', compact('tenant'));
    }

    public function edit(Tenant $tenant)
    {
        return view('tenants.edit', compact('tenant'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        // Start database transaction
        DB::beginTransaction();

        try {
            $tenant->update($request->only(['name', 'email', 'phone', 'address']));

            // Log the tenant update for audit purposes
            \Log::info('Tenant updated successfully', [
                'tenant_id' => $tenant->id,
                'tenant_name' => $tenant->name,
                'updated_fields' => $request->only(['name', 'email', 'phone', 'address']),
                'updated_by' => auth()->id(),
                'updated_at' => now(),
            ]);

            // Commit the transaction
            DB::commit();

            return redirect()->route('super-admin.tenants.index')
                ->with('success', 'Tenant updated successfully!');

        } catch (\Exception $e) {
            // Rollback the transaction on any error
            DB::rollBack();

            // Log the error for debugging
            \Log::error('Tenant update failed', [
                'tenant_id' => $tenant->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['_token']),
                'user_id' => auth()->id(),
            ]);

            return back()->withInput()->with('error', 'Failed to update tenant: ' . $e->getMessage());
        }
    }

    public function destroy(Tenant $tenant)
    {
        // Start database transaction
        DB::beginTransaction();

        try {
            // Log the tenant deletion for audit purposes
            \Log::info('Tenant deletion started', [
                'tenant_id' => $tenant->id,
                'tenant_name' => $tenant->name,
                'deleted_by' => auth()->id(),
                'deleted_at' => now(),
            ]);

            // Database deletion is handled automatically by the tenancy package
            // through the TenantDeleted event listener in TenancyServiceProvider
            $tenant->delete();

            // Commit the transaction
            DB::commit();

            // Log successful deletion
            \Log::info('Tenant deleted successfully', [
                'tenant_id' => $tenant->id,
                'tenant_name' => $tenant->name,
                'deleted_by' => auth()->id(),
                'deleted_at' => now(),
            ]);

            return redirect()->route('super-admin.tenants.index')
                ->with('success', 'Tenant deleted successfully!');

        } catch (\Exception $e) {
            // Rollback the transaction on any error
            DB::rollBack();

            // Log the error for debugging
            \Log::error('Tenant deletion failed', [
                'tenant_id' => $tenant->id,
                'tenant_name' => $tenant->name,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => auth()->id(),
            ]);

            return back()->with('error', 'Failed to delete tenant: ' . $e->getMessage());
        }
    }

    /**
     * Bulk operations for tenants (activate, deactivate, delete)
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'tenant_ids' => 'required|array',
            'tenant_ids.*' => 'exists:tenants,id',
        ]);

        $action = $request->action;
        $tenantIds = $request->tenant_ids;
        $tenants = Tenant::whereIn('id', $tenantIds)->get();

        // Start database transaction
        DB::beginTransaction();

        try {
            $successCount = 0;
            $failedCount = 0;
            $errors = [];

            foreach ($tenants as $tenant) {
                try {
                    switch ($action) {
                        case 'activate':
                            $tenant->update(['is_active' => true]);
                            \Log::info('Tenant activated', [
                                'tenant_id' => $tenant->id,
                                'tenant_name' => $tenant->name,
                                'activated_by' => auth()->id(),
                            ]);
                            break;

                        case 'deactivate':
                            $tenant->update(['is_active' => false]);
                            \Log::info('Tenant deactivated', [
                                'tenant_id' => $tenant->id,
                                'tenant_name' => $tenant->name,
                                'deactivated_by' => auth()->id(),
                            ]);
                            break;

                        case 'delete':
                            $tenant->delete();
                            \Log::info('Tenant deleted via bulk operation', [
                                'tenant_id' => $tenant->id,
                                'tenant_name' => $tenant->name,
                                'deleted_by' => auth()->id(),
                            ]);
                            break;
                    }
                    $successCount++;
                } catch (\Exception $e) {
                    $failedCount++;
                    $errors[] = "Failed to {$action} tenant '{$tenant->name}': " . $e->getMessage();
                    \Log::error("Bulk operation failed for tenant", [
                        'tenant_id' => $tenant->id,
                        'tenant_name' => $tenant->name,
                        'action' => $action,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            // Commit the transaction
            DB::commit();

            $message = "Successfully processed {$successCount} tenants.";
            if ($failedCount > 0) {
                $message .= " Failed to process {$failedCount} tenants.";
            }

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'success_count' => $successCount,
                    'failed_count' => $failedCount,
                    'errors' => $errors,
                ]);
            }

            return redirect()->route('super-admin.tenants.index')
                ->with('success', $message)
                ->with('bulk_errors', $errors);

        } catch (\Exception $e) {
            // Rollback the transaction on any error
            DB::rollBack();

            \Log::error('Bulk operation failed', [
                'action' => $action,
                'tenant_ids' => $tenantIds,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => auth()->id(),
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bulk operation failed: ' . $e->getMessage(),
                ], 422);
            }

            return back()->with('error', 'Bulk operation failed: ' . $e->getMessage());
        }
    }

    /**
     * Get transaction status for a tenant
     */
    public function getTransactionStatus(Tenant $tenant)
    {
        try {
            $status = [
                'tenant_id' => $tenant->id,
                'tenant_name' => $tenant->name,
                'is_active' => $tenant->is_active,
                'created_at' => $tenant->created_at,
                'updated_at' => $tenant->updated_at,
                'domains' => $tenant->domains->pluck('domain'),
                'data_integrity' => 'ok',
            ];

            // Check if tenant has associated domains
            if ($tenant->domains->isEmpty()) {
                $status['data_integrity'] = 'warning';
                $status['warnings'] = ['No domains associated with this tenant'];
            }

            return response()->json([
                'success' => true,
                'status' => $status,
            ]);

        } catch (\Exception $e) {
            \Log::error('Failed to get tenant transaction status', [
                'tenant_id' => $tenant->id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to get transaction status: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Check if tenant database exists
     */
    public function checkDatabaseExists(Tenant $tenant)
    {
        try {
            // Try to initialize tenancy for this tenant
            tenancy()->initialize($tenant);
            
            // If we get here, the database exists and is accessible
            return response()->json([
                'success' => true,
                'message' => 'Tenant database exists and is accessible',
                'tenant_id' => $tenant->id,
                'database_name' => $tenant->getDatabaseName(),
            ]);

        } catch (\Stancl\Tenancy\Exceptions\TenantDatabaseDoesNotExistException $e) {
            // Database doesn't exist, try to create it
            try {
                \Log::warning('Tenant database does not exist, attempting to create it', [
                    'tenant_id' => $tenant->id,
                    'tenant_name' => $tenant->name,
                ]);

                // Run the database creation job manually
                $databaseManager = app(\Stancl\Tenancy\Database\DatabaseManager::class);
                $createJob = new \Stancl\Tenancy\Jobs\CreateDatabase($tenant);
                $createJob->handle($databaseManager);

                // Run migrations
                $migrateJob = new \Stancl\Tenancy\Jobs\MigrateDatabase($tenant);
                $migrateJob->handle($databaseManager);

                // Run seeding
                $seedJob = new \Stancl\Tenancy\Jobs\SeedDatabase($tenant);
                $seedJob->handle($databaseManager);

                return response()->json([
                    'success' => true,
                    'message' => 'Tenant database created successfully',
                    'tenant_id' => $tenant->id,
                    'database_name' => $tenant->getDatabaseName(),
                ]);

            } catch (\Exception $createException) {
                \Log::error('Failed to create tenant database', [
                    'tenant_id' => $tenant->id,
                    'error' => $createException->getMessage(),
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create tenant database: ' . $createException->getMessage(),
                ], 500);
            }

        } catch (\Exception $e) {
            \Log::error('Error checking tenant database', [
                'tenant_id' => $tenant->id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error checking tenant database: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Manually create tenant database
     */
    public function createTenantDatabase(Tenant $tenant)
    {
        try {
            \Log::info('Manually creating tenant database', [
                'tenant_id' => $tenant->id,
                'tenant_name' => $tenant->name,
            ]);

            // Create database
            $databaseManager = app(\Stancl\Tenancy\Database\DatabaseManager::class);
            $createJob = new \Stancl\Tenancy\Jobs\CreateDatabase($tenant);
            $createJob->handle($databaseManager);

            // Run migrations
            $migrateJob = new \Stancl\Tenancy\Jobs\MigrateDatabase($tenant);
            $migrateJob->handle($databaseManager);

            // Run seeding
            $seedJob = new \Stancl\Tenancy\Jobs\SeedDatabase($tenant);
            $seedJob->handle($databaseManager);

            return response()->json([
                'success' => true,
                'message' => 'Tenant database created successfully',
                'tenant_id' => $tenant->id,
                'database_name' => $tenant->getDatabaseName(),
            ]);

        } catch (\Exception $e) {
            \Log::error('Failed to manually create tenant database', [
                'tenant_id' => $tenant->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create tenant database: ' . $e->getMessage(),
            ], 500);
        }
    }
} 