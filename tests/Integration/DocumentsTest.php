<?php

use Emaia\D4sign\Facades\D4sign;

use function Pest\Faker\faker;

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

it('can upload a attachment to a primary document.', function () {
    $documents = D4sign::documents()->all();
    $document = D4sign::documents()->find($documents[1]['uuidDoc']);

    $file = fopen(__DIR__.'/../Mocks/d4sign-sample-document.pdf', 'r');

    $response = D4sign::documents()->uploadAttachment($document[0]['uuidDoc'], $file);

    expect($response)->toBeArray();
    expect($response)->toHaveKey('message', 'File created');
})->group('integration');

it('can upload a binary document.', function () {
    $safe = D4sign::safes()->all();
    $filePath = __DIR__.'/../Mocks/d4sign-sample-document.pdf';
    $fileSize = filesize($filePath);
    $file = base64_encode(fread(fopen($filePath, 'rb'), $fileSize));
    $mimeType = 'application/pdf';
    $name = 'Sample Document';

    $response = D4sign::documents()->uploadBinary($safe[0]['uuid_safe'], $file, $mimeType, $name);

    expect($response)->toBeArray();
    expect($response)->toHaveKey('uuid');
})->group('integration');

it('can upload a attachment binary to the primary document.', function () {
    $documents = D4sign::documents()->all();
    $document = D4sign::documents()->find($documents[1]['uuidDoc']);
    $filePath = __DIR__.'/../Mocks/d4sign-sample-document.pdf';
    $fileSize = filesize($filePath);
    $file = base64_encode(fread(fopen($filePath, 'rb'), $fileSize));
    $mimeType = 'application/pdf';
    $name = 'Sample Document Binary';

    $response = D4sign::documents()->uploadBinaryAttachment($document[0]['uuidDoc'], $file, $mimeType, $name);

    expect($response)->toBeArray();
    expect($response)->toHaveKey('message', 'File created');
})->group('integration');

it('can upload a document hash.', function () {
    $safe = D4sign::safes()->all();
    $filePath = __DIR__.'/../Mocks/d4sign-sample-document.pdf';

    $fileSha256 = hash('sha256', $filePath);
    $fileSha512 = hash('sha512', $filePath);
    $fileName = 'Sample Document Hash';

    $response = D4sign::documents()->uploadHash(
        $safe[0]['uuid_safe'],
        hash('sha256', $fileSha256),
        hash('sha512', $fileSha512),
        $fileName,
    );

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

it('can get all documents by status.', function () {
    $response = D4sign::documents()->byStatus(faker()->numberBetween(1, 7));

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys([
        'total_documents',
        'total_in_this_page',
        'current_page',
        'total_pages',
    ]);
})->group('integration');

it('can get all document signers.', function () {
    $documents = D4sign::documents()->all();
    $response = D4sign::documents()->signers($documents[1]['uuidDoc']);

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys([
        'uuidDoc',
        'list',
    ]);
})->group('integration');

it('can register a signer in a document.', function () {
    $safe = D4sign::safes()->all();

    $file = fopen(__DIR__.'/../Mocks/d4sign-sample-document.pdf', 'r');

    $uploadedFile = D4sign::documents()->upload($safe[0]['uuid_safe'], $file);

    $signers = [
        [
            'email' => faker()->safeEmail,
            'act' => 1,
            'foreign' => 0,
            'certificadoicpbr' => 0,
            'assinatura_presencial' => 0,
        ],
    ];

    $response = D4sign::documents()->addSigners($uploadedFile['uuid'], $signers);

    expect($response)->toBeArray();
    expect($response['message'][0])->toHaveKeys([
        'key_signer',
        'email',
    ]);
})->group('integration');
