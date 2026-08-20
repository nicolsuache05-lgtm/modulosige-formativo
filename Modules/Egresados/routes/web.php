<?php

use Illuminate\Support\Facades\Route;
use Modules\Egresados\Http\Controllers\EgresadosController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('egresados', EgresadosController::class)->names('egresados');
});
