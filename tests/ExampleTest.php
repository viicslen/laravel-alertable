<?php


use ViicSlen\LaravelAlertable\Facades\Alert;

it('can test', function () {
    $alert = Alert::create(message: 'Test');
    expect($alert->message)->toBe('Test');
});
