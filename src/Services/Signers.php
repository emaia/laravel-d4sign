<?php

namespace Emaia\D4sign\Services;

use Emaia\D4sign\Service;

class Signers extends Service
{

    public function all(string $uuidDocument): array
    {
        return $this->client->get("documents/$uuidDocument/list");
    }

    public function add(string $uuidDocument, array $signers): array
    {
        return $this->client->post(
            "documents/$uuidDocument/createlist",
            ['signers' => json_encode($signers)]
        );
    }

    public function remove(string $uuidDocument, string $signerEmail, string $signerKey): array
    {
        return $this->client->post(
            "documents/$uuidDocument/removeemaillist",
            ['email-signer' => $signerEmail, 'key-signer' => $signerKey]
        );
    }

}
