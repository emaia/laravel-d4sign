<?php

use Emaia\D4sign\Facades\D4sign;

it('can get all groups in a safe.', function () {
    $safe = D4sign::safes()->all();

    $response = D4sign::groups()->all($safe[0]["uuid_safe"]);

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys(['uuid_grupo', 'nome']);
})->group('integration');
