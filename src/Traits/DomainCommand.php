<?php

namespace Aammui\DDD\Traits;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class DomainCommand
 * @package Aammui\DDD
 */
trait DomainCommand
{
    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
            ['domain', InputArgument::REQUIRED, 'The domain of the class'],
        ];
    }


    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        $options = parent::getOptions();

        return array_merge($options, [
            ['domain', 'd', InputOption::VALUE_NONE, 'Create a controller based on ddd architecture'],
        ]);
    }


    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param string $name
     *
     * @return string
     */
    protected function buildClass($name)
    {
        $replace["use AppHttp\Controllers\Controller;\n"] = "use ".config("ddd.controller_path").";\n";

        return str_replace(array_keys($replace), array_values($replace), parent::buildClass($name));
    }

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

        return config('ddd.application').'\\'.$domain.'\Controllers';
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getDomainInput()
    {
        return ucfirst(trim($this->argument('domain')));
    }
}
