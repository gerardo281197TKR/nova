<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CiclesController;
use App\Http\Controllers\CompanyController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get("/logout", [App\Http\Controllers\Auth\LoginController::class, "logout"])->name("logout");
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware("auth")->group(function () {

    Route::prefix("/users")->group(function () {
        Route::controller(UserController::class)->group(function(){
            Route::get("/new", "new");
            Route::get("/list", "list");
            Route::get("/profile", "profile");
        });
    });

    Route::prefix("/cicles")->group(function () {
        Route::controller(CiclesController::class)->group(function(){
            Route::get("/new", "new");
            Route::get("/list", "list");
        });
    });

    Route::prefix("/company")->group(function () {
        Route::controller(CompanyController::class)->group(function(){
            Route::get("/plan", "plan");
            Route::get("/payments", "payments");
        });
    });

});