<?php

namespace Aammui\DDD\Commands;

use Aammui\DDD\Contracts\DomainCommand;
use Aammui\DDD\Traits\DomainCommand as DomainCommandTrait;
use Illuminate\Routing\Console\ControllerMakeCommand as BaseControllerMakeCommandAlias;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class ControllerMakeCommand
 * @package Aammui\DDD\Commands
 */
class ControllerMakeCommand extends BaseControllerMakeCommandAlias implements DomainCommand
{

    use DomainCommandTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ddd:controller';
}
