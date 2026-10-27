<?php

namespace Modules\Egresados\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class EgresadosServiceProvider extends ModuleServiceProvider
{
    /**
     * The name of the module.
     */
    protected string $name = 'Egresados';

    /**
     * The lowercase version of the module name.
     */
    protected string $nameLower = 'egresados';

    /**
     * Command classes to register.
     *
     * @var string[]
     */
    protected array $commands = [
        \Modules\Egresados\Console\Commands\TestCorreoInstitucionalCommand::class,
        \Modules\Egresados\Console\Commands\SyncSigeCommand::class,
    ];

    /**
     * Provider classes to register.
     *
     * @var string[]
     */
    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        parent::register();

        $this->app->singleton(\Modules\Egresados\Services\SigeSyncService::class);
        $this->app->alias(\Modules\Egresados\Services\SigeSyncService::class, 'sige.sync');

        if (!class_exists('App\Services\SigeSyncService')) {
            class_alias(\Modules\Egresados\Services\SigeSyncService::class, 'App\Services\SigeSyncService');
        }
        if (!class_exists('App\Models\Egresado')) {
            class_alias(\Modules\Egresados\Models\Egresado::class, 'App\Models\Egresado');
        }
    }

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        parent::boot();

        \Illuminate\Pagination\Paginator::defaultView('egresados::partials.pagination');
    }
}
