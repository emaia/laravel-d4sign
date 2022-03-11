<?php

use Emaia\D4sign\Facades\D4sign;

it('can test api call.', function () {
    $result = D4sign::account()->testCall();

    expect($result)->toHaveKeys(['message']);
})->group('integration');

it('can check the account balance.', function () {
    $result = D4sign::account()->balance();

    expect($result)->toHaveKeys([
        'credit',
        'sent',
        'used_balance',
        'sms',
        'whatsapp'
    ]);
})->group('integration');
