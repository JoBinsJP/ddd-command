<?php

namespace Aammui\DDD\Commands;

use Illuminate\Console\Command;

class ControllerMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:controller {controller} {d} {--r}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Controller class in a DDD architecture.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $controller = $this->argument('controller');
        $domain = $this->argument('d');
        $namespace = config('ddd.controller') . '\\' . ucfirst($domain) . '\\Controllers';
        $this->exportBackend($namespace, ucfirst($controller));
    }

    /**
     * Create the directories for the files.
     *
     * @return void
     */
    protected function ensureDirectoriesExist($directory)
    {
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }

    public function ensureFileExist($file)
    {
        if (!file_exists($file)) {
            $file = fopen(base_path($file), "w");
            fclose($file);
        }
    }


    /**
     * Export the authentication backend.
     *
     * @return void
     */
    protected function exportBackend($namespace, $class)
    {
        $directory = lcfirst(str_replace('\\', '/', $namespace));
        $file =  $directory . '/' . $class . '.php';
        $this->ensureDirectoriesExist($directory);
        $this->ensureFileExist($file);

        $data = $this->compileControllerStub($namespace, $class);
        file_put_contents(base_path($file), $data);
    }

    /**
     * Compiles the "HomeController" stub.
     *
     * @return string
     */
    protected function compileControllerStub($namespace, $class)
    {
        $data =  str_replace(
            '{{namespace}}',
            $namespace,
            file_get_contents(__DIR__ . '/../stubs/controller.stub')
        );
        return str_replace('{{class}}', $class, $data);
    }
}
