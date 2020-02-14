<?php

namespace Spatie\Tail\Tests;

use File;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Routing\Router;
use Orchestra\Testbench\TestCase as Orchestra;
use Route;
use Spatie\ResponseCache\Facades\ResponseCache;
use Spatie\ResponseCache\Middlewares\CacheResponse;
use Spatie\ResponseCache\Middlewares\DoNotCacheResponse;
use Spatie\ResponseCache\ResponseCacheServiceProvider;
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
