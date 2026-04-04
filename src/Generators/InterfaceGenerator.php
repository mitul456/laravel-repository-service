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
        $namespace = config('repository-service.repository_namespace') . '\\Contracts';
        $path = config('repository-service.repository_path') . '/Contracts';

        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $interfaceName = $this->name . 'RepositoryInterface';
        $filePath = $path . '/' . $interfaceName . '.php';

        $stub = file_get_contents(base_path('stubs/interface.stub'));
        $stub = str_replace('{{ namespace }}', $namespace, $stub);
        $stub = str_replace('{{ class }}', $interfaceName, $stub);

        file_put_contents($filePath, $stub);
    }
}