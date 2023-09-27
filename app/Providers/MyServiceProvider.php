<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\UserService;

class MyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserService::class, function ($app, $parameters = []) {
            $response = $parameters['response'] ?? null;
            $parameter = $parameters['parameter'] ?? null;

            return new UserService($response, $parameter);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
