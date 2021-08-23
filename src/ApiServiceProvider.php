<?php

namespace Seatplus\Api;

use Illuminate\Support\ServiceProvider;
use Seatplus\Api\Http\Middleware\TokenAbilityCheck;
use Seatplus\Web\Http\Middleware\CheckPermissionAffiliation;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Publish the JS & CSS,
        $this->addPublications();

        // Add routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        //Add Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations/');

        // Add Middlewares
        $this->addMiddleware();

        // Add translations
        //$this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'web');
    }

    public function register()
    {
        $this->mergeConfigurations();
    }

    private function mergeConfigurations()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/api.sidebar.php',
            'package.sidebar'
        );

        $this->mergeConfigFrom(
            __DIR__ . '/../config/api.permissions.php',
            'eveapi.permissions'
        );
    }

    private function addPublications()
    {
        /*
         * to publish assets one can run:
         * php artisan vendor:publish --tag=web --force
         * or use Laravel Mix to copy the folder to public repo of core.
         */
        $this->publishes([
            __DIR__ . '/../resources/js' => resource_path('js'),
        ], 'web');
    }

    private function addMiddleware()
    {
        $router = $this->app['router'];

        $router->aliasMiddleware('api-permission', CheckPermissionAffiliation::class);

        $router->aliasMiddleware('token-ability-check', TokenAbilityCheck::class);
    }
}
