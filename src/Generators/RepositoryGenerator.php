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
        $repositoryPath = config('repository-service.repository_path');
        $repositoryNamespace = config('repository-service.repository_namespace');
        $contractNamespace = $repositoryNamespace . '\\Contracts';
        $contractPath = $repositoryPath . '/Contracts';

        // Ensure directories exist
        if (!is_dir($repositoryPath)) {
            mkdir($repositoryPath, 0755, true);
        }

        if (!is_dir($contractPath)) {
            mkdir($contractPath, 0755, true);
        }

        // 1️⃣ Generate Interface first
        $interfaceGenerator = new InterfaceGenerator($this->name);
        $interfaceGenerator->generate();

        // 2️⃣ Generate Repository class
        $className = $this->name . 'Repository';
        $interfaceName = $this->name . 'RepositoryInterface';

        $repositoryFilePath = $repositoryPath . '/' . $className . '.php';
        $stub = file_get_contents(base_path('stubs/repository.stub'));
        $stub = str_replace('{{ namespace }}', $repositoryNamespace, $stub);
        $stub = str_replace('{{ class }}', $className, $stub);
        $stub = str_replace('{{ interface }}', $interfaceName, $stub);

        file_put_contents($repositoryFilePath, $stub);
    }
}