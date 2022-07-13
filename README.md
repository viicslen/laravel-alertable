# This is my package laravel-alertable

[![Latest Version on Packagist](https://img.shields.io/packagist/v/viicslen/laravel-alertable.svg?style=flat-square)](https://packagist.org/packages/viicslen/laravel-alertable)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/viicslen/laravel-alertable/run-tests?label=tests)](https://github.com/viicslen/laravel-alertable/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/viicslen/laravel-alertable/Check%20&%20fix%20styling?label=code%20style)](https://github.com/viicslen/laravel-alertable/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/viicslen/laravel-alertable.svg?style=flat-square)](https://packagist.org/packages/viicslen/laravel-alertable)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require viicslen/laravel-alertable
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="alertable-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="alertable-config"
```

This is the contents of the published config file:

```php
return [
    /**
     * The default model to use for alerts.
     */
    'model' => ViicSlen\LaravelAlertable\Models\Alert::class,

    /**
     * Connection settings to use for the default alerts model.
     */
    'database' => [
        /**
         * The connection to use. If left nulls, the default connection will be used.
         */
        'connection' => null,

        /**
         * The table to use. If left nulls, the default connection will be used.
         */
        'table' => null,
    ]
];
```

## Usage

First define any model as alertable by adding the `HasAlerts` trait to your model (and optionally the `Alertable` interface):
```php
<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use ViicSlen\LaravelAlertable\Concerns\HasAlerts;
use ViicSlen\LaravelAlertable\Contracts\Alertable;

class User extends Authenticatable implements Alertable
{
    use HasAlerts;
}
```

### Create an alert:
```php
use ViicSlen\LaravelAlertable\Enums\Severity;

// ...

$user = Auth::user();

$user->newAlert('This is a test alert', ['extra' => 'data'], Severity::Success);
```

### Retrieve alerts:
```php
$user = Auth::user();

// Get all alerts
$user->alerts()->get();

// Get alerts with a specific severity
$user->infoAlerts()->get();
$user->successAlerts()->get();
$user->warningAlerts()->get();
$user->errorAlerts()->get();

// Get latest alert
$user->latestAlert
```

### Delete alerts:
```php
use ViicSlen\LaravelAlertable\Enums\Severity;

// ...

// Delete all alerts
$user->clearAlerts()

// Delete alerts with a specific severity
$user->clearAlerts(Severity::Success)

// Delete alerts with a specific severity and category
$user->clearAlerts(Severity::Success, 'CATEGORY_1')
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/viicslen/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Victor Rivero](https://github.com/viicslen)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
