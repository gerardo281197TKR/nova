<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Auth\LoginController;

Route::post('/generate-token', [LoginController::class, 'generateToken']);
// Rutas protegidas
Route::middleware('auth:api')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::get('/profile', [UserController::class, 'profile']);
    
    // Otras rutas protegidas aquí
});

