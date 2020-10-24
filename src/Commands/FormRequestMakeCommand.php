<?php

namespace Aammui\DDD\Commands;

use Illuminate\Console\Command;

class FormRequestMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:request {request} {d}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a FormRequest class in a DDD architecture.';

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
        $class = $this->argument('request');
        $domain = $this->argument('d');
        $namespace = config('ddd.application') . '\\' . ucfirst($domain) . '\\Requests';
        $this->exportBackend($namespace, ucfirst($class));
        $this->info("Form request created successfully.");
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
            $file = fopen($file, "w");
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
        file_put_contents($file, $data);
    }

    /**
     *
     * @return string
     */
    protected function compileControllerStub($namespace, $class)
    {
        $data =  str_replace(
            '{{namespace}}',
            $namespace,
            file_get_contents(__DIR__ . '/../stubs/request.stub')
        );
        return str_replace('{{class}}', $class, $data);
    }
}
