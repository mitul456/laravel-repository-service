<?php

namespace Mitul456\LaravelRepositoryService\Generators;

use Mitul456\LaravelRepositoryService\Generators\InterfaceGenerator;

class RepositoryGenerator
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function generate(): void
    {
        // Config values
        $repositoryPath = config('repository-service.repository_path', app_path('Repositories'));
        $repositoryNamespace = config('repository-service.repository_namespace', 'App\\Repositories');
        $contractNamespace = $repositoryNamespace . '\\Contracts';
        $contractPath = $repositoryPath . DIRECTORY_SEPARATOR . 'Contracts';

        // Ensure directories exist
        $this->makeDirectory($repositoryPath);
        $this->makeDirectory($contractPath);

        // 1️⃣ Generate Interface first
        $interfaceGenerator = new InterfaceGenerator($this->name);
        $interfaceGenerator->generate();

        // 2️⃣ Generate Repository class
        $className = $this->name . 'Repository';
        $interfaceName = $this->name . 'RepositoryInterface';

        $repositoryFilePath = $repositoryPath . DIRECTORY_SEPARATOR . $className . '.php';
        $stubPath = base_path('stubs/repository.stub');

        if (!file_exists($stubPath)) {
            throw new \Exception("Stub file not found: {$stubPath}");
        }

        $stub = file_get_contents($stubPath);
        $stub = str_replace('{{ namespace }}', $repositoryNamespace, $stub);
        $stub = str_replace('{{ class }}', $className, $stub);
        $stub = str_replace('{{ interface }}', $interfaceName, $stub);

        file_put_contents($repositoryFilePath, $stub);
    }

    protected function makeDirectory(string $path): void
    {
        if (!is_dir($path)) {
            if (!@mkdir($path, 0755, true) && !is_dir($path)) {
                throw new \Exception("Cannot create directory: {$path}");
            }
        }
    }
}