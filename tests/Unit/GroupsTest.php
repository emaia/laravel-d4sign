<?php

use Emaia\D4sign\Facades\D4sign;

use function Pest\Faker\faker;

it('can get all groups in a safe.', function () {
    mockHttpResponse(
        [
            [
                "uuid_grupo" => "348452a7-3357-444b-90a9-7f043aaac29b",
                "nome" => "Test group"
            ]
        ]
    );

    $result = D4sign::groups()->all(faker()->uuid);

    expect($result)->toBeArray();
    expect($result[0])->toHaveKeys(['uuid_grupo', 'nome']);
});
