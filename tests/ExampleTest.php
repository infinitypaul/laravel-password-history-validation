<?php

namespace Infinitypaul\LaravelPasswordHistoryValidation\Tests;

use Infinitypaul\LaravelPasswordHistoryValidation\LaravelPasswordHistoryValidationServiceProvider;
use Orchestra\Testbench\TestCase;

class ExampleTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [LaravelPasswordHistoryValidationServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
