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
    public function ddd_create_controller_command()
    {
        Artisan::call('ddd:test LoginTest auth');
        $output = Artisan::output();
        $file = __DIR__ . '/../tests/Feature/Auth/LoginTest.php';
        $this->assertTrue(file_exists($file));
    }
}
