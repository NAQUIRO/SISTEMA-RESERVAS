<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/v1/auth/login', [AuthController::class, "funIngresar"]);
Route::post('/v1/auth/register', [AuthController::class, "funRegistro"]);
Route::get('/v1/auth/profile', [UserController::class, "funPerfil"]);
Route::get('/v1/auth/logout', [UserController::class, "funSalir"]);

// Rutas para mesas
Route::apiResource('tables', TableController::class);
Route::get('tables/available/{date}/{time}', [TableController::class, 'getAvailableTables']);

// Rutas para reservas
Route::apiResource('reservations', ReservationController::class);
Route::put('reservations/{reservation}/status', [ReservationController::class, 'updateStatus']);