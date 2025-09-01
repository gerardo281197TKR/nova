<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->usePublicPath(base_path().'/public_html');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configuración de Passport para Laravel 12
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
        
        // Configuración básica de Passport para Laravel 12
        // Los modelos se configuran automáticamente en las versiones más recientes
    }
}
