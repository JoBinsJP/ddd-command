<?php

namespace Jobins\DDDCommand\Tests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

/**
 * Class FormRequestCommandTest
 *
 * @package Jobins\DDDCommand\Tests
 */
class RequestCommandTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    public function tearDown(): void
    {
        File::deleteDirectory(base_path("app"));
    }

    /** @test */
    public function ddd_create_request_command()
    {
        Artisan::call('ddd:request UserCreateRequest auth');

        $file = __DIR__.'/../app/Application/Auth/Requests/UserCreateRequest.php';
        $this->assertTrue(file_exists($file));

        require $file;
        $this->assertInstanceOf(FormRequest::class, (new \App\Application\Auth\Requests\UserCreateRequest()));
    }

    /** @test */
    public function ddd_create_controller_command_on_specified_application_layer()
    {
        Artisan::call('ddd:request UserCreateRequest auth api');

        $file = __DIR__.'/../app/API/Auth/Requests/UserCreateRequest.php';
        $this->assertTrue(file_exists($file));
        require $file;
        $this->assertInstanceOf(FormRequest::class, (new \App\API\Auth\Requests\UserCreateRequest()));
    }
}
