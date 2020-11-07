<?php

namespace Aammui\DDD\Commands;

use Aammui\DDD\Traits\StubCompilerTrait;
use Illuminate\Console\Command;

class ModelMakeCommand extends Command
{
    use StubCompilerTrait;

    const STUB_PATH = __DIR__ . '/../stubs/model.stub';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:model {model} {d}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a model class in a DDD architecture.';

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
        $controller = $this->argument('model');
        $domain = $this->argument('d');
        $namespace = config('ddd.domain') . '\\' . ucfirst($domain) . '\\Models';
        $this->exportBackend($namespace, ucfirst($controller), $this->getStubPath());
        $this->info("Model created successfully.");
    }

    /**
     * Get stub path.
     * 
     * @param bool $isResource 
     * @return string 
     */
    public function getStubPath($isResource = false)
    {
        return self::STUB_PATH;
    }
}
