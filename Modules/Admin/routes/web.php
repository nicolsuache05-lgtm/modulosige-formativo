<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\UsuarioController;
use Modules\Admin\Http\Controllers\RolController;
use Modules\Admin\Http\Controllers\PermisoController;
use Modules\Admin\Http\Controllers\AuditoriaController;

Route::prefix('admin')->name('admin.')->group(function () {
    // Landing institucional y Dashboard
    Route::get('/', [AdminController::class, 'welcome'])->name('welcome');
    Route::get('/index', [AdminController::class, 'welcome'])->name('index');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Gestión de Usuarios
    Route::prefix('usuarios')->name('usuarios.')->group(function () {
        Route::get('/', [UsuarioController::class, 'index'])->name('index');
        Route::get('/create', [UsuarioController::class, 'create'])->name('create');
        Route::post('/', [UsuarioController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UsuarioController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UsuarioController::class, 'update'])->name('update');
        Route::delete('/{id}', [UsuarioController::class, 'destroy'])->name('destroy');
    });

    // Gestión de Roles
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RolController::class, 'index'])->name('index');
        Route::get('/create', [RolController::class, 'create'])->name('create');
        Route::post('/', [RolController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RolController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RolController::class, 'update'])->name('update');
        Route::delete('/{id}', [RolController::class, 'destroy'])->name('destroy');
    });

    // Catálogo de Permisos
    Route::prefix('permisos')->name('permisos.')->group(function () {
        Route::get('/', [PermisoController::class, 'index'])->name('index');
    });

    // Auditoría y Trazabilidad
    Route::prefix('auditoria')->name('auditoria.')->group(function () {
        Route::get('/', [AuditoriaController::class, 'index'])->name('index');
        Route::get('/{id}', [AuditoriaController::class, 'show'])->name('show');
    });
});
