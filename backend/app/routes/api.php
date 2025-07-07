<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/app/load', [App\Http\Controllers\AppController::class, 'load'])->name('app.load');

Route::post('/auth/login', [App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
Route::post('/auth/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');
Route::post('/auth/register', [App\Http\Controllers\AuthController::class, 'register'])->name('auth.register');
Route::post('/auth/password', [App\Http\Controllers\AuthController::class, 'password'])->name('auth.password');

Route::apiResource('app_user', App\Http\Controllers\AppUserController::class)->except(['destroy']);
