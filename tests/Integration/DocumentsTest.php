<?php

use Emaia\D4sign\Facades\D4sign;

it('can get all documents in the account (limited by 500 per page).', function () {
    $result = D4sign::documents()->all();

    expect($result)->toBeArray();
    expect($result[0])->toHaveKeys([
        'total_documents',
        'total_in_this_page',
        'current_page',
        'total_pages'
    ]);
})->group('integration');

it('can get all documents in the account on page 2.', function () {
    $result = D4sign::documents()->all(2);

    expect($result)->toBeArray();
    expect($result[0])->toHaveKey('current_page','2');
})->group('integration');

it('can upload a primary document.', function () {

    $safe = D4sign::safes()->all();

    $file = fopen(__DIR__.'/../Mocks/d4sign-sample-document.pdf', 'r');

    $result = D4sign::documents()->upload($safe[0]['uuid_safe'], $file);

    expect($result)->toBeArray();
    expect($result)->toHaveKey('uuid');

})->group('integration');

it('can get a documents by id.', function () {

    $documents = D4sign::documents()->all();
    $result = D4sign::documents()->find($documents[1]['uuidDoc']);

    expect($result)->toBeArray();
    expect($result[0])->toHaveKeys([
        'uuidDoc',
        'nameDoc'
    ]);
})->group('integration');

it('can get all documents from a safe.', function () {
    $result = D4sign::documents()->fromSafe('06b3ddb1-abc9-4ab8-b944-0d7c940486af');

    expect($result)->toBeArray();
    expect($result[0])->toHaveKeys([
        'uuidDoc',
        'nameDoc'
    ]);
})->group('integration');

it('can get all documents from a folder.', function () {
    $result = D4sign::documents()->fromFolder('06b3ddb1-abc9-4ab8-b944-0d7c940486af', '6e2a7667-b440-4cf9-ae02-cdab85f2eeea');

    expect($result)->toBeArray();
    expect($result[0])->toHaveKeys([
        'uuidDoc',
        'nameDoc'
    ]);
})->group('integration');
