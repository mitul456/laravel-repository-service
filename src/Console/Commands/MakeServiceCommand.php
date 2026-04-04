<?php

namespace Mitul456\LaravelRepositoryService\Console\Commands;

use Illuminate\Console\Command;
use Mitul456\LaravelRepositoryService\Generators\ServiceGenerator;

class MakeServiceCommand extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Generate a service class';

    public function handle()
    {
        $name = $this->argument('name');

        $generator = new ServiceGenerator($name);
        $generator->generate();

        $this->info("Service {$name} created successfully.");
    }
}