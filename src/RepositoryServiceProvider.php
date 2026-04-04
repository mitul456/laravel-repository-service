<?php

namespace Mitul456\LaravelRepositoryService;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $repositoryNamespace = config('repository-service.repository_namespace');
        $repositoryPath = app_path('Repositories'); // default path

        // Scan Contracts folder
        $contractsPath = $repositoryPath . '/Contracts';

        if (is_dir($contractsPath)) {
            $files = scandir($contractsPath);

            foreach ($files as $file) {
                if (Str::endsWith($file, 'RepositoryInterface.php')) {
                    $interfaceName = pathinfo($file, PATHINFO_FILENAME);
                    $className = str_replace('Interface', '', $interfaceName);

                    $interfaceFQN = $repositoryNamespace . '\\Contracts\\' . $interfaceName;
                    $classFQN = $repositoryNamespace . '\\' . $className;

                    // Bind interface to class
                    $this->app->bind($interfaceFQN, $classFQN);
                }
            }
        }
    }

    public function boot(): void
    {
        //
    }
}