<?php

use Illuminate\Support\Facades\Route;
use Modules\Egresados\Http\Controllers\EgresadosController;
use Modules\Egresados\Http\Controllers\AuthController;
use Modules\Egresados\Http\Controllers\EncuestasController;
use Modules\Egresados\Http\Controllers\ReportesController;
use Modules\Egresados\Http\Controllers\EventosController;
use Modules\Egresados\Http\Controllers\InstructorController;
use Modules\Egresados\Http\Controllers\InstructorEncuestasController;

// 1. Portal Público de Bienvenida (lo que ven los egresados al entrar a /egresados)
Route::get('egresados', [EgresadosController::class, 'welcome'])->name('egresados.welcome');
Route::get('egresados/welcome', [EgresadosController::class, 'welcome'])->name('egresados.landing');

// 2. Autenticación Centralizada ERP (Redirección al Login Institucional)
Route::get('egresados/login', function (\Illuminate\Http\Request $request) {
    $redirect = $request->query('redirect', route('egresados.welcome'));
    return redirect()->route('login', ['redirect' => $redirect]);
})->name('egresados.login');

Route::match(['get', 'post'], 'egresados/logout', function (\Illuminate\Http\Request $request) {
    $redirect = $request->input('redirect', $request->query('redirect', route('egresados.welcome')));
    return redirect()->route('logout', ['redirect' => $redirect]);
})->name('egresados.logout');

// 3. Módulo de Superadmin / Coordinación
Route::get('egresados/dashboard', [EgresadosController::class, 'dashboard'])->name('egresados.dashboard');
Route::get('egresados/superadmin/dashboard', [EgresadosController::class, 'dashboard'])->name('egresados.superadmin.dashboard');
Route::get('egresados/directorio', [EgresadosController::class, 'index'])->name('egresados.index');
Route::post('egresados/superadmin/store', [EgresadosController::class, 'store'])->name('egresados.superadmin.store');
Route::get('egresados/{id}/perfil', [EgresadosController::class, 'show'])->name('egresados.superadmin.perfil');
Route::put('egresados/{id}/update', [EgresadosController::class, 'update'])->name('egresados.superadmin.update');
Route::post('egresados/seguimiento/store', [EgresadosController::class, 'storeSeguimiento'])->name('egresados.superadmin.seguimiento.store');
Route::get('egresados/instructores', [EgresadosController::class, 'instructoresIndex'])->name('egresados.instructores');
Route::get('egresados/superadmin/instructores', [EgresadosController::class, 'instructoresIndex'])->name('egresados.superadmin.instructores.index');
Route::post('egresados/superadmin/instructores/store', [EgresadosController::class, 'instructoresStore'])->name('egresados.superadmin.instructores.store');

// Rutas para Encuestas (Superadmin)
Route::get('egresados/encuestas-superadmin', [EncuestasController::class, 'index'])->name('egresados.encuestas_superadmin');
Route::get('egresados/encuestas', [EncuestasController::class, 'index'])->name('egresados.encuestas');
Route::get('egresados/superadmin/encuestas', [EncuestasController::class, 'index'])->name('egresados.superadmin.encuestas.index');
Route::post('egresados/superadmin/encuestas/store', [EncuestasController::class, 'store'])->name('egresados.superadmin.encuestas.store');
Route::get('egresados/superadmin/encuestas/{id}/resultados', [EncuestasController::class, 'resultados'])->name('egresados.superadmin.encuestas.resultados');
Route::get('egresados/encuestas/{id}/resultados', [EncuestasController::class, 'resultados'])->name('egresados.encuestas.resultados');
Route::put('egresados/superadmin/encuestas/{id}/cerrar', [EncuestasController::class, 'cerrar'])->name('egresados.superadmin.encuestas.cerrar');
Route::put('egresados/encuestas/{id}/cerrar', [EncuestasController::class, 'cerrar'])->name('egresados.encuestas.cerrar');

// Rutas para Reportes (Superadmin)
Route::get('egresados/reportes', [ReportesController::class, 'index'])->name('egresados.reportes');
Route::get('egresados/superadmin/reportes', [ReportesController::class, 'index'])->name('egresados.superadmin.reportes.index');
Route::post('egresados/superadmin/reportes/store', [ReportesController::class, 'store'])->name('egresados.superadmin.reportes.store');
Route::get('egresados/superadmin/reportes/export/{id?}', [ReportesController::class, 'export'])->name('egresados.superadmin.reportes.export');
Route::get('egresados/superadmin/reportes/{id}/exportar/{formato}', [ReportesController::class, 'exportar'])->name('egresados.superadmin.reportes.exportar');
Route::get('egresados/superadmin/reportes/{id}/graficas', [ReportesController::class, 'graficas'])->name('egresados.superadmin.reportes.graficas');
Route::post('egresados/superadmin/reportes/{id}/enviar', [ReportesController::class, 'enviarCorreo'])->name('egresados.superadmin.reportes.enviar');
Route::delete('egresados/superadmin/reportes/{id}', [ReportesController::class, 'destroy'])->name('egresados.superadmin.reportes.destroy');
// Rutas para Eventos (Superadmin)
Route::get('egresados/eventos', [EventosController::class, 'index'])->name('egresados.eventos');
Route::get('egresados/superadmin/eventos', [EventosController::class, 'index'])->name('egresados.superadmin.eventos.index');
Route::post('egresados/superadmin/eventos/store', [EventosController::class, 'store'])->name('egresados.superadmin.eventos.store');
Route::get('egresados/superadmin/eventos/{id}', [EventosController::class, 'show'])->name('egresados.superadmin.eventos.show');
Route::get('egresados/superadmin/eventos/{id}/editar', [EventosController::class, 'edit'])->name('egresados.superadmin.eventos.edit');
Route::put('egresados/superadmin/eventos/{id}', [EventosController::class, 'update'])->name('egresados.superadmin.eventos.update');
Route::post('egresados/superadmin/eventos/{id}/invitar', [EventosController::class, 'invitar'])->name('egresados.superadmin.eventos.invitar');
Route::get('egresados/superadmin/eventos/{id}/exportar', [EventosController::class, 'exportarExcel'])->name('egresados.superadmin.eventos.exportar');
Route::put('egresados/superadmin/eventos/{id}/cancelar', [EventosController::class, 'cancelar'])->name('egresados.superadmin.eventos.cancelar');

// 4. Módulo de Instructor
Route::get('egresados/dashboard-instructor', [InstructorController::class, 'dashboard'])->name('egresados.dashboard_instructor');
Route::get('egresados/instructor', [InstructorController::class, 'dashboard'])->name('egresados.instructor');
Route::get('egresados/instructor/dashboard', [InstructorController::class, 'dashboard'])->name('egresados.instructor.dashboard');
Route::get('egresados/instructor/directorio', [InstructorController::class, 'directorio'])->name('egresados.instructor.directorio');
Route::get('egresados/instructor/encuestas', [InstructorEncuestasController::class, 'index'])->name('egresados.instructor.encuestas.index');
Route::post('egresados/instructor/encuestas/store', [InstructorEncuestasController::class, 'store'])->name('egresados.instructor.encuestas.store');

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
