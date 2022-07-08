<?php

namespace ViicSlen\LaravelAlertable;

use Illuminate\Database\Eloquent\Model;
use ViicSlen\LaravelAlertable\Enums\Severity;

class Alert
{
    /**
     * Create a new model instance.
     *
     * @param  string  $message
     * @param  array|null  $data
     * @param  \ViicSlen\LaravelAlertable\Enums\Severity  $severity
     * @param  string|null  $category
     * @return \ViicSlen\LaravelAlertable\Models\Alert|\Illuminate\Database\Eloquent\Model
     */
    public function create(string $message, ?array $data = null, Severity $severity = Severity::Info, ?string $category = null): Models\Alert|Model
    {
        /** @var \ViicSlen\LaravelAlertable\Models\Alert $alert */
        $alert = app(config('alertable.model', Models\Alert::class));

        return $alert::create([
            'message' => $message,
            'data' => $data,
            'severity' => $severity,
            'category' => $category,
        ]);
    }
}
