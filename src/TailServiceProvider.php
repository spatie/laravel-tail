<?php

namespace Spatie\Tail;

use Illuminate\Support\ServiceProvider;

class TailServiceProvider extends ServiceProvider
{
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                TailCommand::class,
            ]);
        }
    }
}
