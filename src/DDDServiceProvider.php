<?php

namespace Aammui\DDD;

use Aammui\DDD\Commands\ControllerMakeCommand;
use Aammui\DDD\Commands\FormRequestMakeCommand;
use Illuminate\Support\ServiceProvider;

class DDDServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/ddd.php',
            'ddd'
        );
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            ControllerMakeCommand::class,
            FormRequestMakeCommand::class
        ]);
    }
}
