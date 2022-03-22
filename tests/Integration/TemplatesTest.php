<?php

use Emaia\D4sign\Facades\D4sign;

it('can list the templates', function () {
    $response = D4sign::templates()->all();
    expect($response)->toBeArray();
    expect($response[1])->toHaveKeys(['id', 'name']);
})->group('integration');
