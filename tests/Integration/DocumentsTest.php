<?php

use Emaia\D4sign\Facades\D4sign;

it('can get all documents in the account (limited by 500 per page).', function () {
    $response = D4sign::documents()->all();

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys([
        'total_documents',
        'total_in_this_page',
        'current_page',
        'total_pages',
    ]);
})->group('integration');

it('can get all documents in the account on page 2.', function () {
    $response = D4sign::documents()->all(2);

    expect($response)->toBeArray();
    expect($response[0])->toHaveKey('current_page', '2');
})->group('integration');

it('can upload a primary document.', function () {
    $safe = D4sign::safes()->all();

    $file = fopen(__DIR__.'/../Mocks/d4sign-sample-document.pdf', 'r');

    $response = D4sign::documents()->upload($safe[0]['uuid_safe'], $file);

    expect($response)->toBeArray();
    expect($response)->toHaveKey('uuid');
})->group('integration');

it('can get a documents by id.', function () {
    $documents = D4sign::documents()->all();
    $response = D4sign::documents()->find($documents[1]['uuidDoc']);

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys([
        'uuidDoc',
        'nameDoc',
    ]);
})->group('integration');

it('can get all documents from a safe.', function () {
    $safes = D4sign::safes()->all();
    $response = D4sign::documents()->fromSafe($safes[0]['uuid_safe']);

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys([
        'total_documents',
        'total_in_this_page',
        'current_page',
        'total_pages',
    ]);
})->group('integration');

it('can get all documents from a folder.', function () {
    $safes = D4sign::safes()->all();
    $folders = D4sign::folders()->find($safes[0]['uuid_safe']);

    $response = D4sign::documents()->fromFolder($safes[0]['uuid_safe'], $folders[0]['uuid_folder']);

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys([
        'total_documents',
        'total_in_this_page',
        'current_page',
        'total_pages',
    ]);
})->group('integration');
