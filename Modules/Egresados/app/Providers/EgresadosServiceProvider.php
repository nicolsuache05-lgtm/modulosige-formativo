<?php

namespace Modules\Egresados\Providers;

use Illuminate\Support\Facades\Route;
use Nwidart\Modules\Support\ModuleServiceProvider;

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
    // protected array $commands = [];

    /**
     * Provider classes to register.
     *
     * @var string[]
     */
    protected array $providers = [
        EventServiceProvider::class,
    ];

    public function boot(): void
    {
        parent::boot();

        Route::middleware('web')
            ->group(module_path($this->name, '/routes/web.php'));
    }

    /**
     * Define module schedules.
     * 
     * @param $schedule
     */
    // protected function configureSchedules(Schedule $schedule): void
    // {
    //     $schedule->command('inspire')->hourly();
    // }
}
