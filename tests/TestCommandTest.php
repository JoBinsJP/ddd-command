<?php

namespace Jobins\DDDCommand\Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Jobins\DDDCommand\Tests\TestCase as BaseTestCase;

/**
 * Class TestCommandTest
 * @package Jobins\DDDCommand\Tests
 */
class TestCommandTest extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    public function tearDown(): void
    {
        File::deleteDirectory(base_path("tests/Feature"));
        File::deleteDirectory(base_path("tests/Unit"));
    }

    /** @test */
    public function ddd_create_test_command()
    {
        Artisan::call('ddd:test LoginTest auth');
        $output = Artisan::output();
        $file = __DIR__.'/../tests/Feature/Auth/LoginTest.php';
        $this->assertTrue(file_exists($file));
    }

    /** @test */
    public function ddd_create_unit_test_command()
    {
        Artisan::call('ddd:test LoginTest auth --unit');
        $output = Artisan::output();
        $file = __DIR__.'/../tests/Unit/Auth/LoginTest.php';
        $this->assertTrue(file_exists($file));
    }
}
