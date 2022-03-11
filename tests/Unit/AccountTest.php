<?php

use Emaia\D4sign\Facades\D4sign;

it('can test api call.', function () {

    mockHttpResponse(['message' => 'OK']);

    $result = D4sign::account()->testCall();

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['message']);
});

it('can check the account balance.', function () {

    mockHttpResponse(
        [
            'credit' => '',
            'sent' => '',
            'used_balance' => '',
            'sms' => '',
            'whatsapp' => ''
        ]
    );

    $result = D4sign::account()->balance();

    expect($result)->toBeArray();
    expect($result)->toHaveKeys([
        'credit',
        'sent',
        'used_balance',
        'sms',
        'whatsapp'
    ]);
});
