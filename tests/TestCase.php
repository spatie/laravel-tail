<?php

namespace Spatie\Tail\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Tail\TailServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            TailServiceProvider::class,
        ];
    }
}
