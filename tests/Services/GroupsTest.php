<?php

use Emaia\D4sign\Facades\D4sign;

it('can get all groups in a safe.', function () {

    $safe = D4sign::safes()->all();

    $result = D4sign::groups()->all($safe[0]["uuid_safe"]);

    expect($result[0])->toHaveKeys(['uuid_grupo', 'nome']);

});
