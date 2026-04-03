<?php

namespace Mitul456\LaravelRepositoryService\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeServiceCommand extends Command
{
    protected $signature = 'make:service {name} {--repository=}';
    protected $description = 'Create a new service class';

    public function handle()
    {
        $name = $this->argument('name');
        $repository = $this->option('repository') ?? $name;
        
        $servicePath = config('repository-service.paths.services');
        
        if (!File::exists($servicePath)) {
            File::makeDirectory($servicePath, 0755, true);
        }
        
        $serviceContent = $this->generateServiceContent($name, $repository);
        File::put($servicePath . "/{$name}Service.php", $serviceContent);
        
        $this->info("✓ Service created successfully!");
    }
    
    private function generateServiceContent($name, $repository): string
    {
        return "<?php\n\nnamespace " . config('repository-service.service_namespace') . ";\n\nuse " . config('repository-service.contract_namespace') . "\\{$repository}RepositoryInterface;\n\nclass {$name}Service\n{\n    protected \${$repository}Repository;\n\n    public function __construct({$repository}RepositoryInterface \${$repository}Repository)\n    {\n        \$this->{$repository}Repository = \${$repository}Repository;\n    }\n\n    public function getAll()\n    {\n        return \$this->{$repository}Repository->all();\n    }\n\n    public function find(\$id)\n    {\n        return \$this->{$repository}Repository->find(\$id);\n    }\n\n    public function create(array \$data)\n    {\n        return \$this->{$repository}Repository->create(\$data);\n    }\n\n    public function update(\$id, array \$data)\n    {\n        return \$this->{$repository}Repository->update(\$id, \$data);\n    }\n\n    public function delete(\$id)\n    {\n        return \$this->{$repository}Repository->delete(\$id);\n    }\n\n    // Add your business logic here\n}\n";
    }
}