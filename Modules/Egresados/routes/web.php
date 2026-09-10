<?php

use Illuminate\Support\Facades\Route;
use Modules\Egresados\Http\Controllers\EgresadosController;

// 1. Portal Público de Bienvenida (lo que ven los egresados al entrar a /egresados)
Route::get('egresados', [EgresadosController::class, 'welcome'])->name('egresados.welcome');
Route::get('egresados/welcome', [EgresadosController::class, 'welcome'])->name('egresados.landing');

// 2. Dashboard de Superadmin / Coordinación
Route::get('egresados/dashboard', [EgresadosController::class, 'dashboard'])->name('egresados.dashboard');
Route::get('egresados/dashboard-egresado', [EgresadosController::class, 'dashboardEgresado'])->name('egresados.dashboard_egresado');
Route::get('egresados/encuestas-egresado', [EgresadosController::class, 'encuestasEgresado'])->name('egresados.encuestas_egresado');
Route::get('egresados/oportunidades-egresado', [EgresadosController::class, 'oportunidadesEgresado'])->name('egresados.oportunidades_egresado');

// 3. Directorio y Gestión de Egresados
Route::get('egresados/directorio', [EgresadosController::class, 'index'])->name('egresados.index');

// 3. Rutas CRUD del módulo Egresados
Route::resource('egresados', EgresadosController::class)->except(['index'])->names('egresados');

// 4. Servidor de imágenes y recursos propios de SIGE (sin requerir archivos en public)
Route::get('egresados/assets/images/{filename}', function ($filename) {
    $path = module_path('Egresados', 'resources/assets/images/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->name('egresados.assets.image');
