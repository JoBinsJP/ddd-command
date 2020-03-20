<?php

namespace Aammui\DDD\Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class ModelCommandTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function ddd_create_model_command()
    {
        Artisan::call('ddd:model Transaction Account');
        $output = Artisan::output();
        $file = __DIR__ . '/../app/Domain/Account/Models/Transaction.php';
        $this->assertTrue(file_exists($file));
        require $file;
        $this->assertInstanceOf(Model::class, (new \App\Domain\Account\Models\Transaction()));
    }
}
