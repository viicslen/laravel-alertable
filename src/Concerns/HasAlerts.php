<?php

namespace ViicSlen\LaravelAlertable\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use ViicSlen\LaravelAlertable\Enums\Severity;
use ViicSlen\LaravelAlertable\Models\Alert;

trait HasAlerts
{
    /**
     * Get all alerts for the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function alerts(): MorphMany
    {
        return $this->morphMany(config('alertable.model', Alert::class), 'alertable');
    }

    /**
     * Get the parent's most recent alert.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function latestAlert(): MorphOne
    {
        return $this->morphOne(config('alertable.model', Alert::class), 'alertable')->latestOfMany();
    }

    /**
     * Get info alerts for the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function infoAlerts(): MorphMany
    {
        return $this->alerts()->info();
    }

    /**
     * Get success alerts for the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function successAlerts(): MorphMany
    {
        return $this->alerts()->success();
    }

    /**
     * Get warning alerts for the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function warningAlerts(): MorphMany
    {
        return $this->alerts()->warning();
    }

    /**
     * Get danger alerts for the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function errorAlerts(): MorphMany
    {
        return $this->alerts()->error();
    }

    /**
     * Record provided alert(s) in the database and associate it with the parent model.
     *
     * @param  string  $message
     * @param  array|null  $data
     * @param  \ViicSlen\LaravelAlertable\Enums\Severity  $severity
     * @param  string|null  $category
     * @return \ViicSlen\LaravelAlertable\Models\Alert|\Illuminate\Database\Eloquent\Model
     */
    public function newAlert(string $message, ?array $data = null, Severity $severity = Severity::Info, ?string $category = null): Alert|Model
    {
        return $this->alerts()->create([
            'message' => $message,
            'data' => $data,
            'severity' => $severity,
            'category' => $category,
        ]);
    }

    /**
     * Delete all alerts or alerts with the provided severity from the model.
     *
     * @param  \ViicSlen\LaravelAlertable\Enums\Severity|null  $severity
     * @param  string|null  $category
     * @return void
     */
    public function clearAlerts(?Severity $severity = null, string $category = null): void
    {
        $this->alerts()
            ->when($severity, fn (Builder $query) => $query->where('severity', $severity?->value))
            ->when($category, fn (Builder $query) => $query->where('category', $category))
            ->delete();
    }
}
