<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\User;

Route::post('/generate-token', [LoginController::class, 'generateToken']);
// Rutas protegidas
Route::middleware('auth:api')->group(function(){

    Route::prefix("/users")->group(function(){
        Route::controller(UserController::class)->group(function(){
            Route::get('/show', 'show');
        });
    });
    
});

