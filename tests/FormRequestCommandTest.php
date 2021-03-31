<?php

namespace Jobins\DDDCommand\Tests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

/**
 * Class FormRequestCommandTest
 * @package Jobins\DDDCommand\Tests
 */
class FormRequestCommandTest extends TestCase
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
    public function ddd_create_controller_command()
    {
        Artisan::call('ddd:request UserCreateRequest auth');
        $output = Artisan::output();
        $file   = __DIR__.'/../app/Application/Auth/Requests/UserCreateRequest.php';
        $this->assertTrue(file_exists($file));
        require $file;
        $this->assertInstanceOf(FormRequest::class, (new \App\Application\Auth\Requests\UserCreateRequest()));
    }
}
