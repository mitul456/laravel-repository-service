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
        // Config values
        $servicePath = config('repository-service.service_path');
        $serviceNamespace = config('repository-service.service_namespace');
        $repositoryNamespace = config('repository-service.repository_namespace');
        $contractNamespace = $repositoryNamespace . '\\Contracts';

        if (!is_dir($servicePath)) {
            mkdir($servicePath, 0755, true);
        }

        $className = $this->name . 'Service';
        $repositoryClass = $this->name . 'Repository';
        $repositoryInterface = $this->name . 'RepositoryInterface';

        $filePath = $servicePath . '/' . $className . '.php';

        $stub = file_get_contents(base_path('stubs/service.stub'));
        $stub = str_replace('{{ namespace }}', $serviceNamespace, $stub);
        $stub = str_replace('{{ class }}', $className, $stub);
        $stub = str_replace('{{ repository_class }}', $repositoryClass, $stub);
        $stub = str_replace('{{ repository_interface }}', $repositoryInterface, $stub);
        $stub = str_replace('{{ repository_contract_namespace }}', $contractNamespace, $stub);

        file_put_contents($filePath, $stub);
    }
}