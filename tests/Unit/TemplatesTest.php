<?php

use Emaia\D4sign\Facades\D4sign;

use function Pest\Faker\faker;

it('can list the templates', function () {
    mockHttpResponse([['id' => faker()->text, 'name' => faker()->text]]);
    $response = D4sign::templates()->all();
    expect($response)->toBeArray();
});
