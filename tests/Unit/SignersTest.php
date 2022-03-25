<?php

use Emaia\D4sign\Facades\D4sign;

use function Pest\Faker\faker;

it('can register a signer in a document', function () {
    mockHttpResponse([
        [
            'key_signer' => faker()->text(5),
            'email' => faker()->email,
        ],
    ]);

    $signers = [
        [
            'email' => faker()->email,
            'act' => faker()->numberBetween(1, 13),
            'foreign' => 0,
            'certificadoicpbr' => 0,
            'assinatura_presencial' => 0,
        ],
    ];

    $response = D4sign::signers()->add(faker()->uuid, $signers);

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys([
        'key_signer',
        'email',
    ]);
});

it('can get all document signers', function () {
    mockHttpResponse([
        [
            'uuidDoc' => faker()->uuid,
            'list' => [],
        ],
    ]);

    $response = D4sign::signers()->all(faker()->uuid);

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys([
        'uuidDoc',
        'list',
    ]);
});

it('can update a signer', function () {
    mockHttpResponse(["message" => "E-mail changed"]);

    $response = D4sign::signers()->update(
        faker()->uuid,
        faker()->email,
        faker()->email,
        faker()->text(6)
    );

    expect($response)->toBeArray();
    expect($response)->toHaveKey('message', 'E-mail changed');
});

it('can remove a document signer', function () {
    mockHttpResponse(['message' => 'E-mail has removed']);

    $response = D4sign::signers()->remove(faker()->uuid, faker()->email, faker()->text(6));

    expect($response)->toBeArray();
    expect($response)->toHaveKey('message', 'E-mail has removed');
});

it('can update the sms number of a signer', function () {
    mockHttpResponse(['message' => 'SMS number changed']);

    $response = D4sign::signers()->updateSms(
        faker()->uuid,
        faker()->email,
        faker()->phoneNumber,
        faker()->text(6)
    );

    expect($response)->toBeArray();
    expect($response)->toHaveKey('message', 'SMS number changed');
});

it('can update the password code of a signer', function () {
    mockHttpResponse(['message' => 'Password code changed']);

    $response = D4sign::signers()->updatePasswordCode(
        faker()->uuid,
        faker()->email,
        faker()->numerify('######'),
        faker()->text(6)
    );

    expect($response)->toBeArray();
    expect($response)->toHaveKey('message', 'Password code changed');
});
