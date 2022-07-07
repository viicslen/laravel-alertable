<?php

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
