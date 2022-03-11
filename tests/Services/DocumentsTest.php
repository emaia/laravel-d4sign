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
});

it('can get all documents in the account on page 2.', function () {
    $result = D4sign::documents()->all(2);

    expect($result)->toBeArray();
    expect($result[0])->toHaveKey('current_page','2');
});

it('can get a documents by id.', function () {
    $result = D4sign::documents()->find('9f08bf18-bf4b-410f-9701-c286e5b1cad1');

    expect($result)->toBeArray();
    expect($result[0])->toHaveKeys([
        'uuidDoc',
        'nameDoc'
    ]);
});

it('can get all documents from a safe.', function () {
    $result = D4sign::documents()->fromSafe('06b3ddb1-abc9-4ab8-b944-0d7c940486af');

    expect($result)->toBeArray();
    expect($result[0])->toHaveKeys([
        'uuidDoc',
        'nameDoc'
    ]);
});

it('can get all documents from a folder.', function () {
    $result = D4sign::documents()->fromFolder('06b3ddb1-abc9-4ab8-b944-0d7c940486af', '6e2a7667-b440-4cf9-ae02-cdab85f2eeea');

    expect($result)->toBeArray();
    expect($result[0])->toHaveKeys([
        'uuidDoc',
        'nameDoc'
    ]);
});
