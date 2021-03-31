<?php

namespace Jobins\DDDCommand\Commands;

use Illuminate\Routing\Console\ControllerMakeCommand as BaseControllerMakeCommandAlias;
use Jobins\DDDCommand\Contracts\DomainCommand;
use Jobins\DDDCommand\Traits\DomainCommand as DomainCommandTrait;

/**
 * Class ControllerMakeCommand
 * @package Jobins\DDDCommand\Commands
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
