<?php

namespace Jobins\DDDCommand\Commands;

use Illuminate\Console\Command;
use Jobins\DDDCommand\Traits\StubCompilerTrait;

/**
 * Class TestMakeCommand
 * @package Jobins\DDDCommand\Commands
 */
class TestMakeCommand extends Command
{
    use StubCompilerTrait;

    public const STUB_PATH      = __DIR__.'/../stubs/test.stub';
    public const STUB_UNIT_PATH = __DIR__.'/../stubs/test.unit.stub';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:test {test} {d} {--U|unit}';

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
        $class  = $this->argument('test');
        $domain = $this->argument('d');
        $isUnit = $this->option('unit');
        $this->exportBackend($this->getNamespace($domain, $isUnit), ucfirst($class), $this->getStubPath($isUnit));
        $this->info("Test created successfully.");
    }

    /**
     * Get namespace based on is unit.
     *
     * @param mixed $domain
     * @param mixed $isUnit
     *
     * @return string
     */
    public function getNamespace($domain, $isUnit)
    {
        if ( $isUnit ) {
            return 'Tests\Unit'.'\\'.ucfirst($domain);
        }

        return 'Tests\Feature'.'\\'.ucfirst($domain);
    }

    /**
     * Get stub path based on commands.
     *
     * @param bool $isUnit
     *
     * @return string
     */
    public function getStubPath($isUnit = false)
    {
        if ( $isUnit ) {
            return self::STUB_UNIT_PATH;
        }

        return self::STUB_PATH;
    }
}
