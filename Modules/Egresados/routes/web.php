<?php

use Illuminate\Support\Facades\Route;
use Modules\Egresados\Http\Controllers\EgresadosController;
use Modules\Egresados\Http\Controllers\AuthController;
use Modules\Egresados\Http\Controllers\EncuestasController;
use Modules\Egresados\Http\Controllers\ReportesController;
use Modules\Egresados\Http\Controllers\EventosController;
use Modules\Egresados\Http\Controllers\InstructorController;
use Modules\Egresados\Http\Controllers\InstructorEncuestasController;
use Modules\Egresados\Http\Middleware\CheckEgresadosRole;

/*
|--------------------------------------------------------------------------
| Web Routes - Módulo de Egresados (SIGE)
|--------------------------------------------------------------------------
| Protección de datos confidenciales, control estricto de roles y redirección segura.
*/

// 1. Portal Público Informativo
Route::get('egresados', [EgresadosController::class, 'welcome'])->name('egresados.welcome');
Route::get('egresados/welcome', [EgresadosController::class, 'welcome'])->name('egresados.landing');

// 2. Autenticación Institucional Centralizada del ERP
Route::get('egresados/login', function (\Illuminate\Http\Request $request) {
    $redirect = $request->query('redirect', route('egresados.welcome'));
    return redirect()->route('login', ['redirect' => $redirect]);
})->name('egresados.login');

Route::post('egresados/login', [AuthController::class, 'login'])->name('egresados.login.post');

Route::match(['get', 'post'], 'egresados/logout', function (\Illuminate\Http\Request $request) {
    $redirect = $request->input('redirect', $request->query('redirect', route('egresados.welcome')));
    return redirect()->route('logout', ['redirect' => $redirect]);
})->name('egresados.logout');

// Redirección inteligente al autenticarse en SIGE
Route::get('egresados/home', [AuthController::class, 'showLoginForm'])->name('egresados.home');

// Panel Exclusivo de Autoregistro para Egresados del CEFA (Público)
Route::get('egresados/registro', [EgresadosController::class, 'showRegistro'])->name('egresados.registro');
Route::post('egresados/registro', [EgresadosController::class, 'processRegistro'])->name('egresados.registro.post');
Route::get('egresados/create', [EgresadosController::class, 'create'])->name('egresados.create');
Route::post('egresados/create', [EgresadosController::class, 'store'])->name('egresados.store');
Route::get('egresados/crear', [EgresadosController::class, 'create']);

// 3. Servidor de recursos estáticos propios del módulo
Route::get('egresados/assets/images/{filename}', function ($filename) {
    // Sanitizar nombre de archivo para evitar Directory Traversal
    $cleanFilename = basename($filename);
    $path = module_path('Egresados', 'resources/assets/images/' . $cleanFilename);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->name('egresados.assets.image');


// --------------------------------------------------------------------------
// 4. ÁREA SUPERADMINISTRADOR / ADMINISTRADOR DE EGRESADOS (Datos Confidenciales)
// --------------------------------------------------------------------------
Route::middleware([CheckEgresadosRole::class . ':superadmin'])->group(function () {
    // Dashboard general y métricas
    Route::get('egresados/dashboard', [EgresadosController::class, 'dashboard'])->name('egresados.dashboard');
    Route::get('egresados/superadmin/dashboard', [EgresadosController::class, 'dashboard'])->name('egresados.superadmin.dashboard');

    // Directorio y gestión de egresados
    Route::get('egresados/directorio', [EgresadosController::class, 'index'])->name('egresados.index');
    Route::get('egresados/superadmin/directorio', [EgresadosController::class, 'index'])->name('egresados.superadmin.directorio');
    Route::get('egresados/superadmin/create', [EgresadosController::class, 'create'])->name('egresados.superadmin.create');
    Route::post('egresados/superadmin/store', [EgresadosController::class, 'store'])->name('egresados.superadmin.store');
    Route::post('egresados/seguimiento/store', [EgresadosController::class, 'storeSeguimiento'])->name('egresados.superadmin.seguimiento.store');

    // Sincronización SICEFA e Importación Masiva Excel
    Route::post('egresados/superadmin/sincronizar', [EgresadosController::class, 'sincronizarSicefa'])->name('egresados.superadmin.sincronizar');
    Route::post('egresados/superadmin/importar', [EgresadosController::class, 'importarExcel'])->name('egresados.superadmin.importar');

    // Gestión de instructores y evaluadores
    Route::get('egresados/instructores', [EgresadosController::class, 'instructoresIndex'])->name('egresados.instructores');
    Route::get('egresados/superadmin/instructores', [EgresadosController::class, 'instructoresIndex'])->name('egresados.superadmin.instructores.index');
    Route::post('egresados/superadmin/instructores/store', [EgresadosController::class, 'instructoresStore'])->name('egresados.superadmin.instructores.store');

    // Módulo de Encuestas
    Route::get('egresados/encuestas-superadmin', [EncuestasController::class, 'index'])->name('egresados.encuestas_superadmin');
    Route::get('egresados/encuestas', [EncuestasController::class, 'index'])->name('egresados.encuestas');
    Route::get('egresados/superadmin/encuestas', [EncuestasController::class, 'index'])->name('egresados.superadmin.encuestas.index');
    Route::post('egresados/superadmin/encuestas/store', [EncuestasController::class, 'store'])->name('egresados.superadmin.encuestas.store');
    Route::get('egresados/superadmin/encuestas/{id}/resultados', [EncuestasController::class, 'resultados'])->name('egresados.superadmin.encuestas.resultados')->whereNumber('id');
    Route::get('egresados/encuestas/{id}/resultados', [EncuestasController::class, 'resultados'])->name('egresados.encuestas.resultados')->whereNumber('id');
    Route::put('egresados/superadmin/encuestas/{id}/cerrar', [EncuestasController::class, 'cerrar'])->name('egresados.superadmin.encuestas.cerrar')->whereNumber('id');
    Route::put('egresados/encuestas/{id}/cerrar', [EncuestasController::class, 'cerrar'])->name('egresados.encuestas.cerrar')->whereNumber('id');

    // Módulo de Reportes y Estadísticas
    Route::get('egresados/reportes', [ReportesController::class, 'index'])->name('egresados.reportes');
    Route::get('egresados/superadmin/reportes', [ReportesController::class, 'index'])->name('egresados.superadmin.reportes.index');
    Route::post('egresados/superadmin/reportes/store', [ReportesController::class, 'store'])->name('egresados.superadmin.reportes.store');
    Route::get('egresados/superadmin/reportes/export/{id?}', [ReportesController::class, 'export'])->name('egresados.superadmin.reportes.export');
    Route::get('egresados/superadmin/reportes/{id}/exportar/{formato}', [ReportesController::class, 'exportar'])->name('egresados.superadmin.reportes.exportar');
    Route::get('egresados/superadmin/reportes/{id}/graficas', [ReportesController::class, 'graficas'])->name('egresados.superadmin.reportes.graficas');
    Route::post('egresados/superadmin/reportes/{id}/enviar', [ReportesController::class, 'enviarCorreo'])->name('egresados.superadmin.reportes.enviar');
    Route::delete('egresados/superadmin/reportes/{id}', [ReportesController::class, 'destroy'])->name('egresados.superadmin.reportes.destroy');

    // Módulo de Eventos y Encuentros
    Route::get('egresados/eventos', [EventosController::class, 'index'])->name('egresados.eventos');
    Route::get('egresados/superadmin/eventos', [EventosController::class, 'index'])->name('egresados.superadmin.eventos.index');
    Route::post('egresados/superadmin/eventos/store', [EventosController::class, 'store'])->name('egresados.superadmin.eventos.store');
    Route::get('egresados/superadmin/eventos/{id}', [EventosController::class, 'show'])->name('egresados.superadmin.eventos.show');
    Route::get('egresados/superadmin/eventos/{id}/editar', [EventosController::class, 'edit'])->name('egresados.superadmin.eventos.edit');
    Route::put('egresados/superadmin/eventos/{id}', [EventosController::class, 'update'])->name('egresados.superadmin.eventos.update');
    Route::post('egresados/superadmin/eventos/{id}/invitar', [EventosController::class, 'invitar'])->name('egresados.superadmin.eventos.invitar');
    Route::get('egresados/superadmin/eventos/{id}/exportar', [EventosController::class, 'exportarExcel'])->name('egresados.superadmin.eventos.exportar');
    Route::put('egresados/superadmin/eventos/{id}/cancelar', [EventosController::class, 'cancelar'])->name('egresados.superadmin.eventos.cancelar');

    // Rutas dinámicas con parámetro ID de egresado (al final y con restricción numérica)
    Route::get('egresados/{id}/perfil', [EgresadosController::class, 'show'])->name('egresados.superadmin.perfil')->whereNumber('id');
    Route::get('egresados/{id}', [EgresadosController::class, 'show'])->name('egresados.show')->whereNumber('id');
    Route::put('egresados/{id}/update', [EgresadosController::class, 'update'])->name('egresados.superadmin.update')->whereNumber('id');
    Route::put('egresados/{id}', [EgresadosController::class, 'update'])->name('egresados.update')->whereNumber('id');
});


// --------------------------------------------------------------------------
// 5. ÁREA INSTRUCTOR / EVALUADOR DE SEGUIMIENTO
// --------------------------------------------------------------------------
Route::middleware([CheckEgresadosRole::class . ':instructor'])->group(function () {
    Route::get('egresados/dashboard-instructor', [InstructorController::class, 'dashboard'])->name('egresados.dashboard_instructor');
    Route::get('egresados/instructor', [InstructorController::class, 'dashboard'])->name('egresados.instructor');
    Route::get('egresados/instructor/dashboard', [InstructorController::class, 'dashboard'])->name('egresados.instructor.dashboard');
    Route::get('egresados/instructor/directorio', [InstructorController::class, 'directorio'])->name('egresados.instructor.directorio');
    Route::get('egresados/instructor/encuestas', [InstructorEncuestasController::class, 'index'])->name('egresados.instructor.encuestas.index');
    Route::post('egresados/instructor/encuestas/store', [InstructorEncuestasController::class, 'store'])->name('egresados.instructor.encuestas.store');
    Route::get('egresados/instructor/{id}/perfil', [EgresadosController::class, 'show'])->name('egresados.instructor.perfil');
});


// --------------------------------------------------------------------------
// 6. PORTAL PERSONAL DEL EGRESADO (Protección de Datos Privados)
// --------------------------------------------------------------------------
Route::middleware([CheckEgresadosRole::class . ':egresado'])->group(function () {
    Route::get('egresados/dashboard-egresado', [EgresadosController::class, 'dashboardEgresado'])->name('egresados.dashboard_egresado');
    Route::get('egresados/encuestas-egresado', [EgresadosController::class, 'encuestasEgresado'])->name('egresados.encuestas_egresado');
    Route::get('egresados/oportunidades-egresado', [EgresadosController::class, 'oportunidadesEgresado'])->name('egresados.oportunidades_egresado');
});
