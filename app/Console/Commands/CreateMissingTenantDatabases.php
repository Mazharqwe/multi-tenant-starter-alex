<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;
use Stancl\Tenancy\Jobs\CreateDatabase;
use Stancl\Tenancy\Jobs\MigrateDatabase;
use Stancl\Tenancy\Jobs\SeedDatabase;

class CreateMissingTenantDatabases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:create-missing-databases {--tenant-id= : Specific tenant ID to process} {--force : Force recreation of existing databases}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and create missing tenant databases';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for missing tenant databases...');

        $query = Tenant::query();
        
        if ($tenantId = $this->option('tenant-id')) {
            $query->where('id', $tenantId);
        }

        $tenants = $query->get();

        if ($tenants->isEmpty()) {
            $this->warn('No tenants found.');
            return 1;
        }

        $this->info("Found {$tenants->count()} tenant(s) to process.");
        
        $bar = $this->output->createProgressBar($tenants->count());
        $bar->start();

        $successCount = 0;
        $errorCount = 0;
        $errors = [];

        foreach ($tenants as $tenant) {
            try {
                $this->processTenant($tenant);
                $successCount++;
            } catch (\Exception $e) {
                $errorCount++;
                $errorMessage = "Tenant {$tenant->name} (ID: {$tenant->id}): " . $e->getMessage();
                $errors[] = $errorMessage;
                $this->error($errorMessage);
            }
            
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        // Summary
        $this->info("Processing completed!");
        $this->info("✅ Successfully processed: {$successCount} tenant(s)");
        
        if ($errorCount > 0) {
            $this->error("❌ Failed to process: {$errorCount} tenant(s)");
            $this->newLine();
            $this->warn("Errors encountered:");
            foreach ($errors as $error) {
                $this->line("  • {$error}");
            }
        }

        return $errorCount > 0 ? 1 : 0;
    }

    /**
     * Process a single tenant
     */
    private function processTenant(Tenant $tenant)
    {
        $this->line("Processing tenant: {$tenant->name} (ID: {$tenant->id})");

        try {
            // Check if database exists
            tenancy()->initialize($tenant);
            $this->line("  ✅ Database exists for tenant {$tenant->name}");
            
            if ($this->option('force')) {
                $this->warn("  🔄 Force option enabled - recreating database");
                $this->recreateTenantDatabase($tenant);
            }
            
        } catch (\Stancl\Tenancy\Exceptions\TenantDatabaseDoesNotExistException $e) {
            $this->warn("  ⚠️  Database does not exist for tenant {$tenant->name} - creating...");
            $this->createTenantDatabase($tenant);
        } catch (\Exception $e) {
            throw new \Exception("Failed to check database: " . $e->getMessage());
        }
    }

    /**
     * Create tenant database
     */
    private function createTenantDatabase(Tenant $tenant)
    {
        $this->line("  📦 Creating database for tenant {$tenant->name}...");
        
        // Create database
        $createJob = new CreateDatabase($tenant);
        $createJob->handle($tenant);
        $this->line("  ✅ Database created");

        // Run migrations
        $this->line("  🔄 Running migrations...");
        $migrateJob = new MigrateDatabase($tenant);
        $migrateJob->handle($tenant);
        $this->line("  ✅ Migrations completed");

        // Run seeding
        $this->line("  🌱 Running seeders...");
        $seedJob = new SeedDatabase($tenant);
        $seedJob->handle($tenant);
        $this->line("  ✅ Seeding completed");

        $this->info("  🎉 Tenant database setup completed for {$tenant->name}");
    }

    /**
     * Recreate tenant database
     */
    private function recreateTenantDatabase(Tenant $tenant)
    {
        $this->line("  🗑️  Recreating database for tenant {$tenant->name}...");
        
        // Delete existing database (if exists)
        try {
            $deleteJob = new \Stancl\Tenancy\Jobs\DeleteDatabase($tenant);
            $deleteJob->handle($tenant);
            $this->line("  ✅ Existing database deleted");
        } catch (\Exception $e) {
            $this->warn("  ⚠️  Could not delete existing database: " . $e->getMessage());
        }

        // Create new database
        $this->createTenantDatabase($tenant);
    }
}
