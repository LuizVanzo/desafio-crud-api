<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->post('logout', [AuthController::class, 'logout']);

// LOCAL (protegidas por autenticação)
Route::middleware('auth:api')->group(function () {
	Route::get('local', [\App\Http\Controllers\API\LocalController::class, 'index']); 
	Route::post('local', [\App\Http\Controllers\API\LocalController::class, 'store']); 
	Route::get('local/{id}', [\App\Http\Controllers\API\LocalController::class, 'show']); 
	Route::put('local/{id}', [\App\Http\Controllers\API\LocalController::class, 'update']);
});

