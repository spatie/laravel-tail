<?php

namespace Spatie\Tail;

use Illuminate\Support\ServiceProvider;

class TailServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/tail.php' => config_path('tail.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['command.tail'] = $this->app->share(
            function ($app) {
                return new TailCommand();
            }
        );

        $this->commands('command.tail');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['command.tail'];
    }
}
