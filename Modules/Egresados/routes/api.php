<?php

use Illuminate\Support\Facades\Route;
use Modules\Egresados\Http\Controllers\Controller;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('', EgresadosController::class)->names('egresados');
});
