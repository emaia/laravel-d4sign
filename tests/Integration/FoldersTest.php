<?php

use Emaia\D4sign\Facades\D4sign;

use function Pest\Faker\faker;

beforeEach(function () {
    $safe = D4sign::safes()->all();
    $this->safeUuid = $safe[0]['uuid_safe'];
});

it('can create a new folder in a safe.', function () {
    $result = D4sign::folders()->create($this->safeUuid, faker()->name);

    expect($result)->toHaveKeys(['message', 'uuid']);
})->group('integration');

it('can get all folders in a safe.', function () {
    $result = D4sign::folders()->find($this->safeUuid);

    $this->folderUuid = $result[0]['uuid_safe'];

    expect($result[0])->toHaveKeys(['uuid_safe', 'uuid_folder', 'name', 'dt_cadastro']);
})->group('integration');

it('can rename a folder in a safe.', function () {
    $folder = D4sign::folders()->find($this->safeUuid);

    $result = D4sign::folders()->rename($this->safeUuid, $folder[0]['uuid_folder'], "renamed_{$folder[0]['name']}");

    expect($result)->toHaveKey('message');
})->group('integration');
