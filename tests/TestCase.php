<?php

namespace ViicSlen\LaravelAlertable\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use ViicSlen\LaravelAlertable\AlertableServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            AlertableServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $migration = include __DIR__.'/../database/migrations/create_alerts_table.php.stub';
        $migration->up();
    }
}
