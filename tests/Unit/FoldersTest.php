<?php

use Emaia\D4sign\Facades\D4sign;

use function Pest\Faker\faker;

it('can create a new folder in a safe.', function () {
    mockHttpResponse(['message' => '...', 'uuid' => '...']);

    $result = D4sign::folders()->create(faker()->uuid, faker()->name);

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['message', 'uuid']);
});

it('can get all folders in a safe.', function () {
    mockHttpResponse([
        'uuid_safe' => faker()->uuid,
        'uuid_folder' => faker()->uuid,
        'name' => faker()->name,
        'dt_cadastro' => faker()->dateTime,
    ]);

    $result = D4sign::folders()->find(faker()->uuid);

    expect($result)->toBeArray();
    expect($result)->toHaveKeys(['uuid_safe', 'uuid_folder', 'name', 'dt_cadastro']);
});

it('can rename a folder in a safe.', function () {
    mockHttpResponse(['message' => faker()->text]);

    $result = D4sign::folders()->rename(
        faker()->uuid,
        faker()->uuid,
        faker()->name
    );

    expect($result)->toBeArray();
    expect($result)->toHaveKey('message');
});
