<?php

use Emaia\D4sign\Facades\D4sign;

use function Pest\Faker\faker;

it('can create a new folder in a safe', function () {
    $safe = D4sign::safes()->all();
    $safeUuid = $safe[0]['uuid_safe'];

    $folderName = faker()->text(10);

    $response = D4sign::folders()->create($safeUuid, $folderName);

    expect($response)->toHaveKeys(['message', 'uuid']);

    return [$safeUuid, $response['uuid'], $folderName];
})->group('integration');

it('can get all folders in a safe.', function ($payload) {
    $response = D4sign::folders()->find($payload[0]);

    $this->folderUuid = $response[0]['uuid_safe'];

    expect($response[0])->toHaveKeys(['uuid_safe', 'uuid_folder', 'name', 'dt_cadastro']);
})->depends('it can create a new folder in a safe')->group('integration');

it('can rename a folder in a safe.', function ($payload) {
    $response = D4sign::folders()->rename($payload[0], $payload[1], "renamed_$payload[2]");

    expect($response)->toHaveKey('message');
})->depends('it can create a new folder in a safe')->group('integration');
