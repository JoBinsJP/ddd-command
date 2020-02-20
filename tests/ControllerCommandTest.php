<?php

namespace Aammui\DDD\Tests;

use Illuminate\Support\Facades\Artisan;

class ControllerCommandTest extends TestCase
{
    /** @test */
    public function ddd_create_controller_command()
    {
        Artisan::call('ddd:controller UserController auth');
        $output = Artisan::output();
    }
}
