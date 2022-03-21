<?php

use Emaia\D4sign\Facades\D4sign;

it('can test api call', function () {
    $response = D4sign::account()->testCall();

    expect($response)->toHaveKeys(['message']);
})->group('integration');

it('can check the account balance.', function () {
    $response = D4sign::account()->balance();

    expect($response)->toHaveKeys([
        'credit',
        'sent',
        'used_balance',
        'sms',
        'whatsapp',
    ]);
})->depends('it can test api call')->group('integration');
