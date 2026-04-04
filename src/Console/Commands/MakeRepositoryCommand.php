<?php

namespace Mitul456\LaravelRepositoryService\Console\Commands;

use Illuminate\Console\Command;
use Mitul456\LaravelRepositoryService\Generators\RepositoryGenerator;

class MakeRepositoryCommand extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Generate a repository class';

    public function handle()
    {
        $name = $this->argument('name');

        $generator = new RepositoryGenerator($name);
        $generator->generate();

        $this->info("Repository {$name} created successfully.");
    }
}