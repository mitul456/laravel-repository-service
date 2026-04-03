<?php

namespace Mitul456\LaravelRepositoryService\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeRepositoryServiceCommand extends Command
{
    protected $signature = 'make:repo-service {name} {--model=}';
    protected $description = 'Create repository and service together';

    public function handle()
    {
        $name = $this->argument('name');
        $model = $this->option('model') ?? $name;
        
        $this->call('make:repository', [
            'name' => $name,
            '--model' => $model
        ]);
        
        $this->call('make:service', [
            'name' => "{$name}",
            '--repository' => $name
        ]);
        
        $this->info("🎉 Repository and Service created successfully!");
        $this->info("Don't forget to:");
        $this->info("1. Register repository binding in a service provider");
        $this->info("2. Create your model: php artisan make:model {$model}");
    }
}