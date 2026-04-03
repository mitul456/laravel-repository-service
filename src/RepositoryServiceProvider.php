<?php

namespace Mitul456\LaravelRepositoryService;

use Illuminate\Support\ServiceProvider;
use YourVendor\LaravelRepositoryService\Console\Commands\MakeRepositoryCommand;
use YourVendor\LaravelRepositoryService\Console\Commands\MakeServiceCommand;
use YourVendor\LaravelRepositoryService\Console\Commands\MakeRepositoryServiceCommand;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeRepositoryCommand::class,
                MakeServiceCommand::class,
                MakeRepositoryServiceCommand::class,
            ]);
        }

        // Config publish
        $this->publishes([
            __DIR__ . '/../config/repository-service.php' => config_path('repository-service.php'),
        ], 'repository-service-config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/repository-service.php', 'repository-service');
    }
}