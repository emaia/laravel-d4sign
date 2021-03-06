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

    public function update(string $uuidDocument, string $oldEmail, string $newEmail, string $keySigner = ''): array
    {
        return $this->client->post(
            "documents/$uuidDocument/changeemail",
            [
                'email-before' => $oldEmail,
                'email-after' => $newEmail,
                'key-signer' => $keySigner,
            ]
        );
    }

    public function updateSms(string $uuidDocument, string $email, string $smsNumber, string $keySigner = ''): array
    {
        return $this->client->post(
            "documents/$uuidDocument/changesmsnumber",
            [
                'email' => $email,
                'sms-number' => $smsNumber,
                'key-signer' => $keySigner,
            ]
        );
    }

    public function updatePasswordCode(
        string $uuidDocument,
        string $email,
        string $passwordCode = '',
        string $keySigner = ''
    ): array {
        return $this->client->post(
            "documents/$uuidDocument/changepasswordcode",
            [
                'email' => $email,
                'password-code' => $passwordCode,
                'key-signer' => $keySigner,
            ]
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
