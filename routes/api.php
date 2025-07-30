<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\HttpResponses;
use App\Http\Controllers\Api\HomeController;
use App\Enums\HttpStatusCode;

Route::any('/', [HomeController::class,'index'])->middleware('throttle:60,1');

Route::middleware(['auth:sanctum', 'throttle:60,1'])->get('/user', function (Request $request) {
    return $request->user();
});

# App Versions
require __DIR__.'/v1.php';

# Def
Route::fallback(action: function () {
    return HttpResponses::error(null, null, HttpStatusCode::NotFound, HttpStatusCode::NotFound);
});
