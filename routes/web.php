<?php

use Illuminate\Support\Facades\Route;

Route::any('/', [\App\Http\Controllers\Api\HomeController::class,'index']);

require __DIR__.'/auth.php';
