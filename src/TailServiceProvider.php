<?php

namespace Spatie\Tail;

use Illuminate\Support\ServiceProvider;

class TailServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/tail.php' => config_path('tail.php'),
            ], 'tail-config');


            $this->commands([
                TailCommand::class,
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/tail.php', 'tail');
    }
}
