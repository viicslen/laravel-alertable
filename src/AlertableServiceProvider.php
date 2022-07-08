<?php

namespace ViicSlen\LaravelAlertable;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AlertableServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-alertable')
            ->hasMigration('create_alerts_table')
            ->hasConfigFile();
    }

    public function packageRegistered()
    {
        app()->bind('alertable', Alert::class);
    }
}
