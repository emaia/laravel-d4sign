<?php

use Emaia\D4sign\Facades\D4sign;

it('can test api call.', function () {
    mockHttpResponse(['message' => 'OK']);

    $response = D4sign::account()->testCall();

    expect($response)->toBeArray();
    expect($response)->toHaveKeys(['message']);
});

it('can check the account balance.', function () {
    mockHttpResponse(
        [
            'credit' => '',
            'sent' => '',
            'used_balance' => '',
            'sms' => '',
            'whatsapp' => '',
        ]
    );

    $response = D4sign::account()->balance();

    expect($response)->toBeArray();
    expect($response)->toHaveKeys([
        'credit',
        'sent',
        'used_balance',
        'sms',
        'whatsapp',
    ]);
});
