<?php

use Illuminate\Support\Facades\Route;
use Modules\Egresados\Http\Controllers\EgresadosController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('egresados', EgresadosController::class)->names('egresados');
});
