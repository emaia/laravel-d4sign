<?php

use Emaia\D4sign\Facades\D4sign;

use function Pest\Faker\faker;

it('can get all documents in the account (limited by 500 per page).', function () {
    mockHttpResponse([
        [
            'total_documents' => 1,
            'total_in_this_page' => 1,
            'current_page' => 1,
            'total_pages' => 1,
        ],
    ]);
    $response = D4sign::documents()->all();

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys([
        'total_documents',
        'total_in_this_page',
        'current_page',
        'total_pages',
    ]);
});

it('can get all documents in the account on page 2.', function () {
    mockHttpResponse([
        [
            'total_documents' => 300,
            'total_in_this_page' => 10,
            'current_page' => 2,
            'total_pages' => 30,
        ],
    ]);

    $response = D4sign::documents()->all(2);

    expect($response)->toBeArray();
    expect($response[0])->toHaveKey('current_page', '2');
});

it('can upload a primary document.', function () {
    mockHttpResponse(['uuid' => faker()->uuid]);

    $file = fopen(__DIR__.'/../Mocks/d4sign-sample-document.pdf', 'r');

    $response = D4sign::documents()->upload(faker()->uuid, $file);

    expect($response)->toBeArray();
    expect($response)->toHaveKey('uuid');
});

it('can get a documents by id.', function () {
    mockHttpResponse([['uuidDoc' => faker()->uuid, 'nameDoc' => faker()->text]]);

    $response = D4sign::documents()->find(faker()->uuid);

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys([
        'uuidDoc',
        'nameDoc',
    ]);
});

it('can get all documents from a safe.', function () {
    mockHttpResponse([
        [
            'total_documents' => 5,
            'total_in_this_page' => 1,
            'current_page' => 1,
            'total_pages' => 1,
        ],
    ]);
    $response = D4sign::documents()->fromSafe(faker()->uuid);

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys([
        'total_documents',
        'total_in_this_page',
        'current_page',
        'total_pages',
    ]);
});

it('can get all documents from a folder.', function () {
    mockHttpResponse([
        [
            'total_documents' => 5,
            'total_in_this_page' => 1,
            'current_page' => 1,
            'total_pages' => 1,
        ],
    ]);

    $response = D4sign::documents()->fromFolder(faker()->uuid, faker()->uuid);

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys([
        'total_documents',
        'total_in_this_page',
        'current_page',
        'total_pages',
    ]);
});

it('can get all documents by status.', function () {
    mockHttpResponse([
        [
            'total_documents' => 5,
            'total_in_this_page' => 1,
            'current_page' => 1,
            'total_pages' => 1,
        ],
    ]);

    $response = D4sign::documents()->byStatus(faker()->numberBetween(1, 7));

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys([
        'total_documents',
        'total_in_this_page',
        'current_page',
        'total_pages',
    ]);
});

it('can get all document signers.', function () {
    mockHttpResponse([
        [
            'uuidDoc' => faker()->uuid,
            'list' => [],
        ],
    ]);

    $response = D4sign::documents()->signers(faker()->uuid);

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys([
        'uuidDoc',
        'list',
    ]);
});
