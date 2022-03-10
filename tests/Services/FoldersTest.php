<?php

use Emaia\D4sign\Facades\D4sign;

use function Pest\Faker\faker;

it('can create a new folder in a safe.', function () {
    $safe = D4sign::safes()->all();

    $result = D4sign::folders()->create($safe[0]['uuid_safe'], faker()->name);

    expect($result)->toHaveKeys(['message', 'uuid']);
});

it('can get all folders in a safe.', function () {
    $safe = D4sign::safes()->all();

    $result = D4sign::folders()->find($safe[0]['uuid_safe']);

    expect($result[0])->toHaveKeys(['uuid_safe', 'uuid_folder', 'name', 'dt_cadastro']);
});

it('can rename a folder in a safe.', function () {
    $safe = D4sign::safes()->all();

    $folder = D4sign::folders()->find($safe[0]['uuid_safe']);

    $result = D4sign::folders()->rename($safe[0]['uuid_safe'], $folder[0]['uuid_folder'], "renamed_{$folder[0]['name']}");

    expect($result)->toHaveKey('message');
});
