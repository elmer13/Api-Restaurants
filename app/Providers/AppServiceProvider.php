<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use OpenApi\Annotations as OA;

/**
 * @OA\SecurityScheme(
 *     type="http",
 *     scheme="bearer",
 *     securityScheme="bearerAuth",
 *     bearerFormat="JWT",        
 *     description="Ingresa tu token Bearer en el formato: 'Bearer {token}'"
 * )
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
