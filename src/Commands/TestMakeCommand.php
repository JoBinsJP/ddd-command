<?php

namespace Aammui\DDD\Commands;

use Aammui\DDD\Traits\StubCompilerTrait;
use Illuminate\Console\Command;

class TestMakeCommand extends Command
{
    use StubCompilerTrait;

    const STUB_PATH = __DIR__ . '/../stubs/test.stub';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:test {test} {d}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Test class in a DDD architecture.';

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
        $class = $this->argument('test');
        $domain = $this->argument('d');
        $namespace = config('ddd.tests') . '\\' . ucfirst($domain);
        $this->exportBackend($namespace, ucfirst($class), $this->getStubPath());
        $this->info("Test created successfully.");
    }

    /**
     * Get stub path based on commands.
     * 
     * @param bool $isResource 
     * @return string 
     */
    public function getStubPath($isResource = false)
    {
        return self::STUB_PATH;
    }
}
