<?php

namespace JeffersonGoncalves\Quebec;

use JeffersonGoncalves\Quebec\Commands\InventoryCommand;
use JeffersonGoncalves\Quebec\Commands\KAnonymityCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class QuebecServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('quebec')
            ->hasConfigFile()
            ->hasCommands([InventoryCommand::class, KAnonymityCommand::class]);
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(Quebec::class);
    }
}
