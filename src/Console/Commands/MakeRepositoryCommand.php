<?php

namespace Mitul456\LaravelRepositoryService\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepositoryCommand extends Command
{
    protected $signature = 'make:repository {name} {--model=}';
    protected $description = 'Create a new repository class';

    public function handle()
    {
        $name = $this->argument('name');
        $model = $this->option('model') ?? $name;
        
        $repositoryPath = config('repository-service.paths.repositories');
        $contractPath = config('repository-service.paths.contracts');
        
        // Create directories if not exists
        if (!File::exists($repositoryPath)) {
            File::makeDirectory($repositoryPath, 0755, true);
        }
        
        if (!File::exists($contractPath)) {
            File::makeDirectory($contractPath, 0755, true);
        }
        
        // Create Contract Interface
        $contractContent = $this->generateContractContent($name);
        File::put($contractPath . "/{$name}RepositoryInterface.php", $contractContent);
        
        // Create Repository
        $repositoryContent = $this->generateRepositoryContent($name, $model);
        File::put($repositoryPath . "/{$name}Repository.php", $repositoryContent);
        
        $this->info("✓ Repository created successfully!");
        $this->info("✓ Contract created successfully!");
        $this->info("✓ Don't forget to bind the interface in RepositoryServiceProvider");
    }
    
    private function generateContractContent($name): string
    {
        return "<?php\n\nnamespace " . config('repository-service.contract_namespace') . ";\n\ninterface {$name}RepositoryInterface\n{\n    public function all();\n    public function find(\$id);\n    public function create(array \$data);\n    public function update(\$id, array \$data);\n    public function delete(\$id);\n    public function paginate(\$perPage = 15);\n}\n";
    }
    
    private function generateRepositoryContent($name, $model): string
    {
        return "<?php\n\nnamespace " . config('repository-service.repository_namespace') . ";\n\nuse App\\Models\\{$model};\nuse " . config('repository-service.contract_namespace') . "\\{$name}RepositoryInterface;\nuse YourVendor\LaravelRepositoryService\Traits\BaseRepositoryTrait;\n\nclass {$name}Repository implements {$name}RepositoryInterface\n{\n    use BaseRepositoryTrait;\n\n    public function __construct()\n    {\n        \$this->model = new {$model}();\n    }\n\n    // Add your custom repository methods here\n}\n";
    }
}