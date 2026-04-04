<?php

namespace Mitul456\LaravelRepositoryService\Generators;

class InterfaceGenerator
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function generate(): void
    {
        // Config values with defaults
        $repositoryNamespace = config('repository-service.repository_namespace', 'App\\Repositories');
        $namespace = $repositoryNamespace . '\\Contracts';

        $repositoryPath = config('repository-service.repository_path', app_path('Repositories'));
        $path = $repositoryPath . DIRECTORY_SEPARATOR . 'Contracts';

        // Ensure directory exists
        $this->makeDirectory($path);

        $interfaceName = $this->name . 'RepositoryInterface';
        $filePath = $path . DIRECTORY_SEPARATOR . $interfaceName . '.php';

        $stubPath = __DIR__ . '/../stubs/interface.stub';
        if (!file_exists($stubPath)) {
            throw new \Exception("Stub file not found: {$stubPath}");
        }

        $stub = file_get_contents($stubPath);
        $stub = str_replace('{{ namespace }}', $namespace, $stub);
        $stub = str_replace('{{ class }}', $interfaceName, $stub);

        file_put_contents($filePath, $stub);
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