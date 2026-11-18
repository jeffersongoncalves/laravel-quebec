<?php

namespace JeffersonGoncalves\Quebec;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class QuebecServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-quebec')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations();
    }
}
