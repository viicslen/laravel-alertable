<?php

namespace ViicSlen\LaravelAlertable\Facades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;
use ViicSlen\LaravelAlertable\Enums\Severity;

/**
 * @method static \ViicSlen\LaravelAlertable\Models\Alert|Model create(string $message, ?array $data = null, Severity $severity = Severity::Info, ?string $category = null)
 */
class Alert extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    public static function getFacadeAccessor(): string
    {
        return 'alertable';
    }
}
