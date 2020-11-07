<?php

namespace Aammui\DDD\Tests;

use Illuminate\Support\Facades\Artisan;

class ControllerCommandTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function ddd_create_controller_command()
    {
        Artisan::call('ddd:controller UserController auth');
        $output = Artisan::output();
        $file = __DIR__ . '/../app/Application/Auth/Controllers/UserController.php';
        $this->assertTrue(file_exists($file));
    }

    /** @test */
    public function ddd_create_resource_controller_command()
    {
        Artisan::call('ddd:controller UserController auth --resource');
        $output = Artisan::output();
        $file = __DIR__ . '/../app/Application/Auth/Controllers/UserController.php';
        $this->assertTrue(file_exists($file));
    }
}
