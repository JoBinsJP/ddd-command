<?php

namespace Aammui\DDD\Commands;

use Aammui\DDD\Traits\StubCompilerTrait;
use Illuminate\Console\Command;

class ControllerMakeCommand extends Command
{
    use StubCompilerTrait;

    const STUB_PATH = __DIR__ . '/../stubs/controller.stub';
    const RESOURCE_STUB_PATH = __DIR__ . '/../stubs/controller.resource.stub';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:controller {controller} {d} {--r|resource}';

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
        $isResource = $this->option('resource');
        $namespace = config('ddd.application') . '\\' . ucfirst($domain) . '\\Controllers';
        $this->exportBackend($namespace, ucfirst($controller), $this->getStubPath($isResource));
        $this->info("Controller created successfully.");
    }

    /**
     * Get stub path based on commands.
     * 
     * @param bool $isResource 
     * @return string 
     */
    public function getStubPath($isResource = false)
    {
        if ($isResource) {
            return self::RESOURCE_STUB_PATH;
        }
        return self::STUB_PATH;
    }
}
