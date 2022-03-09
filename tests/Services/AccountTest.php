<?php

use Emaia\D4sign\Facades\D4sign;

it('can check the account balance.', function () {

    $result = D4sign::account()->balance();

    expect($result)->toHaveKey('credit');

});
