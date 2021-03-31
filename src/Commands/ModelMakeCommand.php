<?php

namespace Jobins\DDDCommand\Commands;

use Illuminate\Console\Command;
use Jobins\DDDCommand\Traits\StubCompilerTrait;

/**
 * Class ModelMakeCommand
 * @package Jobins\DDDCommand\Commands
 */
class ModelMakeCommand extends Command
{
    use StubCompilerTrait;

    public const STUB_PATH = __DIR__.'/../stubs/model.stub';

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
        $domain     = $this->argument('d');
        $namespace  = config('ddd.domain').'\\'.ucfirst($domain).'\\Models';
        $this->exportBackend($namespace, ucfirst($controller), $this->getStubPath());
        $this->info("Model created successfully.");
    }

    /**
     * Get stub path.
     *
     * @return string
     */
    public function getStubPath()
    {
        return self::STUB_PATH;
    }
}
