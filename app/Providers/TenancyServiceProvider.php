<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Stancl\JobPipeline\JobPipeline;
use Stancl\Tenancy\Events;
use Stancl\Tenancy\Jobs;
use Stancl\Tenancy\Listeners;
use Stancl\Tenancy\Middleware;

class TenancyServiceProvider extends ServiceProvider
{
    // By default, no namespace is used to support the callable array syntax.
    public static string $controllerNamespace = '';

    public function events()
    {
        return [
            // Tenant events
            Events\CreatingTenant::class => [],
            Events\TenantCreated::class => [
                // Disabled automatic database creation to avoid transaction issues
                // Database creation is now handled manually in TenantController
                function (Events\TenantCreated $event) {
                    \Log::info('Tenant created event fired', [
                        'tenant_id' => $event->tenant->id,
                        'tenant_name' => $event->tenant->name,
                        'note' => 'Database creation handled manually in controller'
                    ]);
                }
                // JobPipeline::make([
                //     Jobs\CreateDatabase::class,
                //     Jobs\MigrateDatabase::class,
                //     Jobs\SeedDatabase::class,
                // ])->send(function (Events\TenantCreated $event) {
                //     return $event->tenant;
                // })->shouldBeQueued(false),
            ],
            Events\SavingTenant::class => [],
            Events\TenantSaved::class => [],
            Events\UpdatingTenant::class => [],
            Events\TenantUpdated::class => [],
            Events\DeletingTenant::class => [],
            Events\TenantDeleted::class => [
                JobPipeline::make([
                    Jobs\DeleteDatabase::class,
                ])->send(function (Events\TenantDeleted $event) {
                    return $event->tenant;
                })->shouldBeQueued(true), // Keep deletion async for better performance
            ],

            // Domain events
            Events\CreatingDomain::class => [],
            Events\DomainCreated::class => [],
            Events\SavingDomain::class => [],
            Events\DomainSaved::class => [],
            Events\UpdatingDomain::class => [],
            Events\DomainUpdated::class => [],
            Events\DeletingDomain::class => [],
            Events\DomainDeleted::class => [],

            // Database events
            Events\DatabaseCreated::class => [
                function (Events\DatabaseCreated $event) {
                    \Log::info('Tenant database created successfully', [
                        'tenant_id' => $event->tenant->id,
                        'tenant_name' => $event->tenant->name,
                    ]);
                }
            ],
            Events\DatabaseMigrated::class => [
                function (Events\DatabaseMigrated $event) {
                    \Log::info('Tenant database migrated successfully', [
                        'tenant_id' => $event->tenant->id,
                        'tenant_name' => $event->tenant->name,
                    ]);
                }
            ],
            Events\DatabaseSeeded::class => [
                function (Events\DatabaseSeeded $event) {
                    \Log::info('Tenant database seeded successfully', [
                        'tenant_id' => $event->tenant->id,
                        'tenant_name' => $event->tenant->name,
                    ]);
                }
            ],
            Events\DatabaseRolledBack::class => [],
            Events\DatabaseDeleted::class => [
                function (Events\DatabaseDeleted $event) {
                    \Log::info('Tenant database deleted successfully', [
                        'tenant_id' => $event->tenant->id,
                        'tenant_name' => $event->tenant->name,
                    ]);
                }
            ],

            // Tenancy events
            Events\InitializingTenancy::class => [],
            Events\TenancyInitialized::class => [
                Listeners\BootstrapTenancy::class,
            ],

            Events\EndingTenancy::class => [],
            Events\TenancyEnded::class => [
                Listeners\RevertToCentralContext::class,
            ],

            Events\BootstrappingTenancy::class => [],
            Events\TenancyBootstrapped::class => [],
            Events\RevertingToCentralContext::class => [],
            Events\RevertedToCentralContext::class => [],

            // Resource syncing
            Events\SyncedResourceSaved::class => [
                Listeners\UpdateSyncedResource::class,
            ],

            // Fired only when a synced resource is changed in a different DB than the origin DB (to avoid infinite loops)
            Events\SyncedResourceChangedInForeignDatabase::class => [],
        ];
    }

    public function register()
    {
        //
    }

    public function boot()
    {
        $this->bootEvents();
        $this->mapRoutes();

        $this->makeTenancyMiddlewareHighestPriority();
    }

    protected function bootEvents()
    {
        foreach ($this->events() as $event => $listeners) {
            foreach ($listeners as $listener) {
                if ($listener instanceof JobPipeline) {
                    $listener = $listener->toListener();
                }

                Event::listen($event, $listener);
            }
        }
    }

    protected function mapRoutes()
    {
        $this->app->booted(function () {
            if (file_exists(base_path('routes/tenant.php'))) {
                Route::namespace(static::$controllerNamespace)
                    ->group(base_path('routes/tenant.php'));
            }
        });
    }

    protected function makeTenancyMiddlewareHighestPriority()
    {
        $tenancyMiddleware = [
            // Even higher priority than the initialization middleware
            Middleware\PreventAccessFromCentralDomains::class,

            Middleware\InitializeTenancyByDomain::class,
            Middleware\InitializeTenancyBySubdomain::class,
            Middleware\InitializeTenancyByDomainOrSubdomain::class,
            Middleware\InitializeTenancyByPath::class,
            Middleware\InitializeTenancyByRequestData::class,
        ];

        foreach (array_reverse($tenancyMiddleware) as $middleware) {
            $this->app[\Illuminate\Contracts\Http\Kernel::class]->prependToMiddlewarePriority($middleware);
        }
    }
}
