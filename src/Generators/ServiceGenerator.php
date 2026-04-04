<?php

namespace Mitul456\LaravelRepositoryService\Generators;

class ServiceGenerator
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function generate(): void
    {
        // Config values with defaults
        $servicePath = config('repository-service.service_path', app_path('Services'));
        $serviceNamespace = config('repository-service.service_namespace', 'App\\Services');
        $repositoryNamespace = config('repository-service.repository_namespace', 'App\\Repositories');
        $contractNamespace = $repositoryNamespace . '\\Contracts';

        // Ensure directory exists
        $this->makeDirectory($servicePath);

        $className = $this->name . 'Service';
        $repositoryClass = $this->name . 'Repository';
        $repositoryInterface = $this->name . 'RepositoryInterface';

        $filePath = $servicePath . DIRECTORY_SEPARATOR . $className . '.php';
        $stubPath = __DIR__ . '/../stubs/service.stub';

        if (!file_exists($stubPath)) {
            throw new \Exception("Stub file not found: {$stubPath}");
        }

        $stub = file_get_contents($stubPath);
        $stub = str_replace('{{ namespace }}', $serviceNamespace, $stub);
        $stub = str_replace('{{ class }}', $className, $stub);
        $stub = str_replace('{{ repository_class }}', $repositoryClass, $stub);
        $stub = str_replace('{{ repository_interface }}', $repositoryInterface, $stub);
        $stub = str_replace('{{ repository_contract_namespace }}', $contractNamespace, $stub);

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