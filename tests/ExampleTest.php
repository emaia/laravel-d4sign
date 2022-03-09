<?php

use Emaia\D4sign\Facades\D4sign;

it('can test', function () {

    $result = D4sign::greet();

    expect($result)->toBe('hello!');
});
