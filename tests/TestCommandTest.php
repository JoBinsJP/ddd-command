<?php

namespace Aammui\DDD\Tests;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Artisan;
use Aammui\DDD\Tests\TestCase as  BaseTestCase;

class TestCommandTest extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function ddd_create_test_command()
    {
        Artisan::call('ddd:test LoginTest auth');
        $output = Artisan::output();
        $file = __DIR__ . '/../tests/Feature/Auth/LoginTest.php';
        $this->assertTrue(file_exists($file));
    }

    /** @test */
    public function ddd_create_unit_test_command()
    {
        Artisan::call('ddd:test LoginTest auth --unit');
        $output = Artisan::output();
        $file = __DIR__ . '/../tests/Feature/Auth/LoginTest.php';
        $this->assertTrue(file_exists($file));
    }
}
