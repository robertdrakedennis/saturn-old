<?php

namespace App\Providers;


use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){
        // for db meme errors
        Schema::defaultStringLength(191);

        // override environment installer and inject sentry dns for error handling
        $this->app->bind('RachidLaasri\LaravelInstaller\Helpers\EnvironmentManager', \App\Services\Binds\EnvironmentManager::class);
        $this->app->bind('RachidLaasri\LaravelInstaller\Controllers\EnvironmentController', \App\Services\Binds\EnvironmentController::class);
        $this->app->bind('RachidLaasri\LaravelInstaller\Controllers\DatabaseController', \App\Services\Binds\DatabaseController::class);
        $this->app->bind('RachidLaasri\LaravelInstaller\Helpers\FinalInstallManager', \App\Services\Binds\FinalInstallManager::class);
    }



    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
