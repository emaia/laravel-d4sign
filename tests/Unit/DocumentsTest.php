<?php

use Emaia\D4sign\Facades\D4sign;

use Emaia\D4sign\Services\Documents;

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

it('can upload an attachment to the primary document.', function () {
    mockHttpResponse(['uuid' => faker()->uuid]);

    $file = fopen(__DIR__.'/../Mocks/d4sign-sample-document.pdf', 'r');

    $response = D4sign::documents()->uploadAttachment(faker()->uuid, $file);

    expect($response)->toBeArray();
    expect($response)->toHaveKey('uuid');
});

it('can upload a binary document.', function () {
    mockHttpResponse(['uuid' => faker()->uuid]);

    $file = base64_encode(faker()->text);
    $mimeType = 'application/pdf';
    $name = 'Sample Document';

    $response = D4sign::documents()->uploadBinary(faker()->uuid, $file, $mimeType, $name);

    expect($response)->toBeArray();
    expect($response)->toHaveKey('uuid');
});

it('can upload an attachment binary to the primary document.', function () {
    mockHttpResponse(['uuid' => faker()->uuid]);

    $file = base64_encode(faker()->text);
    $mimeType = 'application/pdf';
    $name = 'Sample Document';

    $response = D4sign::documents()->uploadBinaryAttachment(faker()->uuid, $file, $mimeType, $name);

    expect($response)->toBeArray();
    expect($response)->toHaveKey('uuid');
});

it('can upload a document hash.', function () {
    mockHttpResponse(['uuid' => faker()->uuid]);

    $file = (faker()->text);
    $name = 'Sample Document';

    $response = D4sign::documents()->uploadHash(
        faker()->uuid,
        hash('sha256', $file),
        hash('sha512', $file),
        $name,
        faker()->uuid
    );

    expect($response)->toBeArray();
    expect($response)->toHaveKey('uuid');
});

it('can get a document by id.', function () {
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

it('can cancel a document', function () {
    $uuidDocument = faker()->uuid;
    mockHttpResponse([['uuidDoc' => $uuidDocument, 'statusName' => 'Cancelado']]);
    $response = D4sign::documents()->cancel($uuidDocument);
    expect($response)->toBeArray();
    expect($response[0])->toHaveKey('uuidDoc', $uuidDocument);
    expect($response[0])->toHaveKey('statusName', 'Cancelado');
});

it('can download a document', function () {
    $uuidDocument = faker()->uuid;
    $type = 'pdf';
    $lang = 'pt';

    mockHttpResponse(['url' => faker()->url, 'name' => faker()->text]);

    $response = D4sign::documents()->download($uuidDocument, $type, $lang);

    expect($response)->toBeArray();
    expect($response)->toHaveKeys(['url', 'name']);
});

it('thrown an invalid argument exception if resource is not valid', function () {
    try {
        $className = get_class(D4sign::documents());
        $reflection = new ReflectionClass($className);
        $method = $reflection->getMethod('isValidResource');
        $method->setAccessible(true);
        return $method->invokeArgs(D4sign::documents(), ['invalid resource param']);
    } catch (ReflectionException $e) {
        throw new Exception($e->getMessage());
    }
})->throws('InvalidArgumentException');
