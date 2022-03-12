<?php

use Emaia\D4sign\Facades\D4sign;

it('can get all account safes.', function () {
    $response = D4sign::safes()->all();

    expect($response[0])->toHaveKeys(['uuid_safe', 'name-safe']);
})->group('integration');
