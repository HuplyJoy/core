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

    Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
        # Auth Routes
        // Route::apiResources([
        //     'index' => UserController::class,
        // ]);
    });
});
