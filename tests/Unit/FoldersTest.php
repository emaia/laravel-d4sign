<?php

use Emaia\D4sign\Facades\D4sign;

use function Pest\Faker\faker;

it('can create a new folder in a safe.', function () {
    mockHttpResponse(['message' => '...', 'uuid' => '...']);

    $response = D4sign::folders()->create(faker()->uuid, faker()->name);

    expect($response)->toBeArray();
    expect($response)->toHaveKeys(['message', 'uuid']);
});

it('can get all folders in a safe.', function () {
    mockHttpResponse([
        'uuid_safe' => faker()->uuid,
        'uuid_folder' => faker()->uuid,
        'name' => faker()->name,
        'dt_cadastro' => faker()->dateTime,
    ]);

    $response = D4sign::folders()->find(faker()->uuid);

    expect($response)->toBeArray();
    expect($response)->toHaveKeys(['uuid_safe', 'uuid_folder', 'name', 'dt_cadastro']);
});

it('can rename a folder in a safe.', function () {
    mockHttpResponse(['message' => faker()->text]);

    $response = D4sign::folders()->rename(
        faker()->uuid,
        faker()->uuid,
        faker()->name
    );

    expect($response)->toBeArray();
    expect($response)->toHaveKey('message');
});
