<?php

namespace Aammui\DDD\Commands;

use Aammui\DDD\Traits\StubCompilerTrait;
use Illuminate\Console\Command;

class FormRequestMakeCommand extends Command
{
    use StubCompilerTrait;

    const STUB_PATH =    __DIR__ . '/../stubs/request.stub';

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
        $this->exportBackend($namespace, ucfirst($class), $this->getStubPath());
        $this->info("Form request created successfully.");
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
