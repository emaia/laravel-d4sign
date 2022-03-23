<?php

use Emaia\D4sign\Facades\D4sign;

use function Pest\Faker\faker;

it('can get all documents in the account (limited by 500 per page)', function () {
    $response = D4sign::documents()->all();

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys([
        'total_documents',
        'total_in_this_page',
        'current_page',
        'total_pages',
    ]);
})->group('integration');

it('can get all documents in the account on page 2', function () {
    $response = D4sign::documents()->all(2);

    expect($response)->toBeArray();
    expect($response[0])->toHaveKey('current_page', '2');
})->group('integration');

it('can upload a primary document', function () {
    $safe = D4sign::safes()->all();

    $file = fopen(__DIR__.'/../Mocks/d4sign-sample-document.pdf', 'r');

    $response = D4sign::documents()->upload($safe[0]['uuid_safe'], $file);

    fclose($file);

    expect($response)->toBeArray();
    expect($response)->toHaveKey('uuid');

    return $response;
})->group('integration');

it('can upload a attachment to a primary document', function ($document) {
    $file = fopen(__DIR__.'/../Mocks/d4sign-sample-document.pdf', 'r');

    $response = D4sign::documents()->uploadAttachment($document['uuid'], $file);

    expect($response)->toBeArray();
    expect($response)->toHaveKey('message', 'File created');
})->depends('it can upload a primary document')->group('integration');

it('can upload a binary document', function () {
    $safe = D4sign::safes()->all();
    $filePath = __DIR__.'/../Mocks/d4sign-sample-document.pdf';
    $fileSize = filesize($filePath);
    $file = base64_encode(fread(fopen($filePath, 'rb'), $fileSize));
    $mimeType = 'application/pdf';
    $name = 'Sample Document';

    $response = D4sign::documents()->uploadBinary($safe[0]['uuid_safe'], $file, $mimeType, $name);

    expect($response)->toBeArray();
    expect($response)->toHaveKey('uuid');

    return $response;
})->group('integration');

it('can upload a binary attachment to the primary document', function ($document) {
    $filePath = __DIR__.'/../Mocks/d4sign-sample-document.pdf';
    $fileSize = filesize($filePath);
    $file = base64_encode(fread(fopen($filePath, 'rb'), $fileSize));
    $mimeType = 'application/pdf';
    $name = 'Sample Document Binary';

    $response = D4sign::documents()->uploadBinaryAttachment($document['uuid'], $file, $mimeType, $name);

    expect($response)->toBeArray();
    expect($response)->toHaveKey('message', 'File created');
})->depends('it can upload a binary document')->group('integration');

it('can upload a document hash', function () {
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

it('can get a documents by id', function ($document) {
    $response = D4sign::documents()->find($document['uuid']);

    expect($response)->toBeArray();
    expect($response[0])->toHaveKeys([
        'uuidDoc',
        'nameDoc',
    ]);
})->depends('it can upload a primary document')->group('integration');

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

it('can add signers in the document', function ($document) {
    $email = faker()->safeEmail;

    $signers = [
        [
            'email' => $email,
            'act' => 1,
            'foreign' => 0,
            'certificadoicpbr' => 0,
            'assinatura_presencial' => 0,
        ],
    ];

    $response = D4sign::signers()->add($document['uuid'], $signers);

    expect($response)->toBeArray();
    expect($response['message'][0])->toHaveKeys(['key_signer', 'email']);

    $key = $response['message'][0]['key_signer'];

    return [$document, $email, $key];
})->depends('it can upload a primary document')->group('integration');

it('can get all document signers', function (array $payload) {
    $response = D4sign::signers()->all($payload[0]['uuid']);

    expect($response)->toBeArray();
    expect($response[0])->toHaveKey('list.0.email', $payload[1]);

    return $payload;
})->depends('it can add signers in the document')->group('integration');

it('can update a signer', function (array $payload) {
    $response = D4sign::signers()->update(
        $payload[0]['uuid'],
        $payload[1],
        'john.doe@example.net'
    );

    expect($response)->toBeArray();
    expect($response)->toHaveKey('message', 'E-mail changed');

    return [$payload[0], 'john.doe@example.net', $payload[2]];
})->depends('it can add signers in the document')->group('integration');

it('can remove a document signer', function (array $payload) {
    $uuidDocument = $payload[0]['uuid'];
    $email = $payload[1];
    $keySigner = $payload[2];

    $response = D4sign::signers()->remove($uuidDocument, $email, $keySigner);

    expect($response)->toBeArray();
    expect($response)->toHaveKey('message', 'E-mail has removed');
})->depends('it can update a signer')->group('integration');

it('can download a document', function ($document) {
    $response = D4sign::documents()->download($document['uuid']);
    expect($response)->toBeArray();
    expect($response)->toHaveKeys(['url', 'name']);
})->depends('it can upload a primary document')->group('integration');


it('can cancel a document', function ($document) {
    $response = D4sign::documents()->cancel($document['uuid'], 'Test cancel comment');
    expect($response)->toBeArray();
    expect($response[0])->toHaveKey('uuidDoc', $document['uuid']);
    expect($response[0])->toHaveKey('statusName', 'Cancelado');
    // expect($response[0])->toHaveKey('statusComment', 'Test cancel comment');
})->depends('it can upload a primary document')->group('integration');
