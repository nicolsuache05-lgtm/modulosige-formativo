<?php

namespace Modules\Egresados\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected string $name = 'Egresados';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(module_path($this->name, '/routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->name('api.')
                ->group(module_path($this->name, '/routes/api.php'));
        });
    }

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        // Las rutas se registran desde boot() para Laravel 13.
    }
}
