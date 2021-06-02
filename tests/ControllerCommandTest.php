<?php

namespace Jobins\DDDCommand\Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

/**
 * Class ControllerCommandTest
 *
 * @package Jobins\DDDCommand\Tests
 */
class ControllerCommandTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();

        File::deleteDirectory(base_path("app"));
    }

    public function tearDown(): void
    {
        File::deleteDirectory(base_path("app"));
    }

    /** @test */
    public function test_new_command()
    {
        Artisan::call("ddd:controller FaceController Login");

        $file = __DIR__.'/../app/Application/Login/Controllers/FaceController.php';
        $this->assertTrue(file_exists($file));
    }

    /** @test */
    public function ddd_create_controller_command()
    {
        Artisan::call('ddd:controller UserController auth -r');

        $file = __DIR__.'/../app/Application/Auth/Controllers/UserController.php';
        $this->assertTrue(file_exists($file));
    }

    /** @test */
    public function ddd_create_resource_controller_command()
    {
        Artisan::call('ddd:controller UserController auth');

        $file = __DIR__.'/../app/Application/Auth/Controllers/UserController.php';
        $this->assertTrue(file_exists($file));
    }

    /** @test */
    public function ddd_create_controller_command_on_different_application_layer()
    {
        Artisan::call('ddd:controller UserController auth api -r');

        $file = __DIR__.'/../app/API/Auth/Controllers/UserController.php';
        $this->assertTrue(file_exists($file));
    }
}
