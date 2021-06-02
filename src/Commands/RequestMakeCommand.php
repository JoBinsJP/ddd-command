<?php

namespace Jobins\DDDCommand\Commands;

use Illuminate\Foundation\Console\RequestMakeCommand as BaseRequestMakeCommand;
use Illuminate\Support\Arr;
use Jobins\DDDCommand\Contracts\DomainCommand;
use Jobins\DDDCommand\Traits\DomainCommand as DomainCommandTrait;

/**
 * Class RequestMakeCommand
 *
 * @package Jobins\DDDCommand\Commands
 */
class RequestMakeCommand extends BaseRequestMakeCommand implements DomainCommand
{
    use DomainCommandTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ddd:request';

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $domain = $this->getDomainInput();

        $config = $this->getConfig();

        $base = ucfirst(Arr::get($config, "path"));

        return $base.'\\'.$domain.'\Requests';
    }
}
