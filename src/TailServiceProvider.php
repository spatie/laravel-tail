<?php

namespace Spatie\Tail;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TailServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-tail')
            ->hasConfigFile()
            ->hasCommand(TailCommand::class);
    }
}
