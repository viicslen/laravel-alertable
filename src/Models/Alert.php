<?php

namespace ViicSlen\LaravelAlertable\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use ViicSlen\LaravelAlertable\Enums\Severity;

/**
 * ViicSlen\LaravelAlertable\Models\Alert
 *
 * @property int $id
 * @property int|null $alertable_id
 * @property string|null $alertable_type
 * @property string $message
 * @property array|null $data
 * @property \ViicSlen\LaravelAlertable\Enums\Severity $severity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder $alertable
 * @method static \Illuminate\Database\Eloquent\Builder|\ViicSlen\LaravelAlertable\Models\Alert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\ViicSlen\LaravelAlertable\Models\Alert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\ViicSlen\LaravelAlertable\Models\Alert query()
 * @method static \Illuminate\Database\Eloquent\Builder|\ViicSlen\LaravelAlertable\Models\Alert whereAlertableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ViicSlen\LaravelAlertable\Models\Alert whereAlertableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ViicSlen\LaravelAlertable\Models\Alert whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ViicSlen\LaravelAlertable\Models\Alert whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ViicSlen\LaravelAlertable\Models\Alert whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ViicSlen\LaravelAlertable\Models\Alert whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ViicSlen\LaravelAlertable\Models\Alert whereSeverity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ViicSlen\LaravelAlertable\Models\Alert whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Alert extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data' => 'array',
        'severity' => Severity::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'message',
        'data',
        'severity',
    ];

    /**
     * Get the current connection name for the model.
     *
     * @return string|null
     */
    public function getConnectionName(): string|null
    {
        if ($connection = config('alertable.database.connection')) {
            return $connection;
        }

        return parent::getConnectionName();
    }

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable(): string
    {
        if ($table = config('alertable.database.table')) {
            return $table;
        }

        return parent::getTable();
    }

    /**
     * Scope a query to only include info alerts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function scopeInfo(Builder $query): Builder
    {
        return $query->where('severity', Severity::Info);
    }

    /**
     * Scope a query to only include success alerts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function scopeSuccess(Builder $query): Builder
    {
        return $query->where('severity', Severity::Success);
    }

    /**
     * Scope a query to only include warning alerts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function scopeWarning(Builder $query): Builder
    {
        return $query->where('severity', Severity::Warning);
    }

    /**
     * Scope a query to only include error alerts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function scopeError(Builder $query): Builder
    {
        return $query->where('severity', Severity::Error);
    }

    /**
     * Get the parent alertable model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function alertable(): MorphTo
    {
        return $this->morphTo();
    }
}
