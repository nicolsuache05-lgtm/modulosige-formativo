<?php

use Illuminate\Support\Facades\Route;
use Modules\Egresados\Http\Controllers\EgresadosController;
use Modules\Egresados\Http\Controllers\AuthController;

// 1. Portal Público de Bienvenida (lo que ven los egresados al entrar a /egresados)
Route::get('egresados', [EgresadosController::class, 'welcome'])->name('egresados.welcome');
Route::get('egresados/welcome', [EgresadosController::class, 'welcome'])->name('egresados.landing');

// 2. Autenticación y Redirección Inteligente por Rol en Egresados
Route::get('egresados/login', [AuthController::class, 'showLoginForm'])->name('egresados.login');
Route::post('egresados/login', [AuthController::class, 'login'])->name('egresados.login.post');
Route::match(['get', 'post'], 'egresados/logout', [AuthController::class, 'logout'])->name('egresados.logout');

// 3. Módulo de Superadmin / Coordinación
Route::get('egresados/dashboard', [EgresadosController::class, 'dashboard'])->name('egresados.dashboard');
Route::get('egresados/directorio', [EgresadosController::class, 'index'])->name('egresados.index');
Route::get('egresados/instructores', [EgresadosController::class, 'instructoresIndex'])->name('egresados.instructores');
Route::get('egresados/encuestas-superadmin', [EgresadosController::class, 'encuestasSuperadminIndex'])->name('egresados.encuestas_superadmin');
Route::get('egresados/encuestas', [EgresadosController::class, 'encuestasSuperadminIndex'])->name('egresados.encuestas');
Route::get('egresados/reportes', [EgresadosController::class, 'reportesSuperadminIndex'])->name('egresados.reportes');
Route::get('egresados/eventos', [EgresadosController::class, 'eventosSuperadminIndex'])->name('egresados.eventos');

// 4. Módulo de Instructor
Route::get('egresados/dashboard-instructor', [EgresadosController::class, 'dashboardInstructor'])->name('egresados.dashboard_instructor');
Route::get('egresados/instructor', [EgresadosController::class, 'dashboardInstructor'])->name('egresados.instructor');

// 5. Módulo de Egresado
Route::get('egresados/dashboard-egresado', [EgresadosController::class, 'dashboardEgresado'])->name('egresados.dashboard_egresado');
Route::get('egresados/encuestas-egresado', [EgresadosController::class, 'encuestasEgresado'])->name('egresados.encuestas_egresado');
Route::get('egresados/oportunidades-egresado', [EgresadosController::class, 'oportunidadesEgresado'])->name('egresados.oportunidades_egresado');

// 6. Rutas CRUD del módulo Egresados
Route::resource('egresados', EgresadosController::class)->except(['index'])->names('egresados');

// 7. Servidor de imágenes y recursos propios de SIGE (sin requerir archivos en public)
Route::get('egresados/assets/images/{filename}', function ($filename) {
    $path = module_path('Egresados', 'resources/assets/images/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->name('egresados.assets.image');
