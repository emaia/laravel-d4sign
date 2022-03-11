<?php

use Emaia\D4sign\Facades\D4sign;

it('can get all account safes.', function () {
    $result = D4sign::safes()->all();

    expect($result[0])->toHaveKeys(['uuid_safe', 'name-safe']);

})->group('integration');
