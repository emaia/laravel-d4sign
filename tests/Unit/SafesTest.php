<?php

use Emaia\D4sign\Facades\D4sign;

use function Pest\Faker\faker;

it('can get all account safes.', function () {
    mockHttpResponse(
        [
            [
                'uuid_safe' => faker()->uuid,
                'name-safe' => faker()->name,
            ],
        ]
    );

    $response = D4sign::safes()->all();

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys(['uuid_safe', 'name-safe']);
});
