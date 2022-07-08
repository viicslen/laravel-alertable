<?php

use ViicSlen\LaravelAlertable\Models\Alert;

it('can test', function () {
    $alert = Alert::create(message: 'Test');
    expect($alert->message)->toBe('Test');
});
