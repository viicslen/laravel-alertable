<?php

namespace ViicSlen\LaravelAlertable\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use ViicSlen\LaravelAlertable\Enums\Severity;
use ViicSlen\LaravelAlertable\Models\Alert;

interface Alertable
{
    /**
     * Get all errors for the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function alerts(): MorphMany;

    /**
     * Record provided alert(s) in the database and associate it with the parent model.
     *
     * @param  string  $message
     * @param  mixed  $data
     * @param  \ViicSlen\LaravelAlertable\Enums\Severity  $severity
     * @return \ViicSlen\LaravelAlertable\Models\Alert|\Illuminate\Database\Eloquent\Model
     */
    public function newAlert(string $message, mixed $data = null, Severity $severity = Severity::Info): Alert|Model;
}