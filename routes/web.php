<?php

use Illuminate\Support\Facades\Route;

Route::any('/', [\App\Http\Controllers\Api\HomeController::class,'index']);
Route::get('/setting/slink', [\App\Http\Controllers\SettingController::class, 'slink'])->name('slink');
Route::get('/setting/optimize', [\App\Http\Controllers\SettingController::class, 'optimize'])->name('optimize');

require __DIR__.'/auth.php';
