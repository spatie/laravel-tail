<?php

namespace Spatie\Tail;

use Illuminate\Support\ServiceProvider;

class TailServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/tail.php' => config_path('tail.php'),
        ], 'tail-config');
    }

    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                TailCommand::class,
            ]);
        }

        $this->mergeConfigFrom(__DIR__.'/../config/tail.php', 'tail');
    }
}
