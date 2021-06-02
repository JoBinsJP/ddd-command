<?php

namespace Jobins\DDDCommand\Commands;

use Illuminate\Routing\Console\ControllerMakeCommand as BaseControllerMakeCommandAlias;
use Illuminate\Support\Arr;
use Jobins\DDDCommand\Contracts\DomainCommand;
use Jobins\DDDCommand\Traits\DomainCommand as DomainCommandTrait;

/**
 * Class ControllerMakeCommand
 *
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

        return $base.'\\'.$domain.'\Controllers';
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
        $config = $this->getConfig();

        $controller = Arr::get($config, "controller");

        $controllerName = basename(str_replace('\\', '/', $controller));

        $replace["use App\Http\Controllers\Controller;\n"] = sprintf("use %s;\n", $controller);
        $replace["extends Controller"] = sprintf("extends %s;", $controllerName);

        return str_replace(array_keys($replace), array_values($replace), parent::buildClass($name));
    }
}
