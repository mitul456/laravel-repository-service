<?php

namespace Mitul456\LaravelRepositoryService\Console\Commands;

use Illuminate\Console\Command;
use Mitul456\LaravelRepositoryService\Generators\RepositoryGenerator;
use Mitul456\LaravelRepositoryService\Generators\ServiceGenerator;

class MakeRepositoryServiceCommand extends Command
{
    protected $signature = 'make:repository-service {name}';
    protected $description = 'Generate both repository and service classes';

    public function handle()
    {
        $name = $this->argument('name');

        (new RepositoryGenerator($name))->generate();
        (new ServiceGenerator($name))->generate();

        $this->info("Repository and Service for {$name} created successfully.");
    }
}