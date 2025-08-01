<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;

/*
|--------------------------------------------------------------------------
| API V1 Routes
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
    # Global Routes
    Route::any('/', [HomeController::class,'index'])->middleware('throttle:60,1');
    Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('login',    [\App\Http\Controllers\Api\AuthController::class, 'login']);

    Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
        # Auth Routes
        Route::get('profile',    [\App\Http\Controllers\Api\AuthController::class, 'profile']);
        Route::post('logout',    [\App\Http\Controllers\Api\AuthController::class, 'logout']);

        Route::get('areas',    [\App\Http\Controllers\Api\AreaController::class, 'index']);
        Route::get('areas/{area}',    [\App\Http\Controllers\Api\AreaController::class, 'show']);

        Route::get('challenges/{area}',    [\App\Http\Controllers\Api\AreaController::class, 'index']);
        Route::get('challenges/{challenge}',    [\App\Http\Controllers\Api\AreaController::class, 'show']);

        Route::get('goals/{challenge}',    [\App\Http\Controllers\Api\AreaController::class, 'index']);
        Route::get('goals/{goal}',    [\App\Http\Controllers\Api\AreaController::class, 'show']);
    });
});
