<?php

namespace Jobins\DDDCommand\Traits;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class DomainCommand
 *
 * @package Jobins\DDDCommand
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
            ["application", InputArgument::OPTIONAL, 'The application in http layer'],
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

        return array_merge(
            $options,
            [
                ['domain', 'd', InputOption::VALUE_NONE, 'Create a controller based on ddd architecture'],
            ]
        );
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getDomainInput(): string
    {
        return ucfirst(trim($this->argument('domain')));
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getApplicationInput(): string
    {
        $application = $this->argument('application');

        if ($application == "" or is_null($application)) {
            $application = config()->get("ddd.application");
        }

        return ucfirst(trim($application));
    }

    /**
     * @return array|mixed
     */
    protected function getConfig()
    {
        $application = strtolower($this->getApplicationInput());

        return config()->get("ddd.applications.{$application}");
    }
}
