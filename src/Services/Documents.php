<?php

namespace Emaia\D4sign\Services;

use Emaia\D4sign\Service;
use InvalidArgumentException;

class Documents extends Service
{
    public function all(int $page = 1): array
    {
        return $this->client->get('documents', ['pg' => $page]);
    }

    public function find(string $uuidDocument = ''): array
    {
        return $this->client->get(sprintf('documents%s', $uuidDocument ? "/$uuidDocument" : ''));
    }

    public function fromSafe(string $uuidSafe, int $page = 1): array
    {
        return $this->client->get("documents/$uuidSafe/safe", ['pg' => $page]);
    }

    public function fromFolder(string $uuidSafe, string $uuidFolder, int $page = 1): array
    {
        return $this->client->get("documents/$uuidSafe/safe/$uuidFolder", ['pg' => $page]);
    }

    public function byStatus(int $documentStatusId, int $page = 1): array
    {
        return $this->client->get("documents/$documentStatusId/status", ['pg' => $page]);
    }

    public function signers(string $uuidDocument): array
    {
        return $this->client->get("documents/$uuidDocument/list");
    }

    public function cancel(string $uuidDocument, string $comment = ''): array
    {
        return $this->client->post("documents/$uuidDocument/cancel", [
            'comment' => json_encode($comment)
        ]);
    }

    public function upload(string $uuidSafe, $file, string $uuidFolder = ''): array
    {
        $this->isValidResource($file);

        return $this->client->attach('file', $file)
            ->post(sprintf('documents%s/upload', $uuidSafe ? "/$uuidSafe" : ''), [
                'uuid_folder' => $uuidFolder,
            ])->json();
    }

    public function uploadAttachment(string $uuidDocument, $file): array
    {
        $this->isValidResource($file);

        return $this->client->attach('file', $file)
            ->post("documents/$uuidDocument/uploadslave")
            ->json();
    }

    public function uploadBinary(
        string $uuidSafe,
        string $base64BinaryFile,
        string $mimeType,
        string $fileName,
        string $uuidFolder = ''
    ): array {
        return $this->client->post("documents/$uuidSafe/uploadbinary", [
            'base64_binary_file' => $base64BinaryFile,
            'mime_type' => $mimeType,
            'name' => $fileName,
            'uuid_folder' => $uuidFolder,
        ]);
    }

    public function uploadBinaryAttachment(
        string $uuidDocument,
        string $base64BinaryFile,
        string $mimeType,
        string $fileName,
    ): array {
        return $this->client->post("documents/$uuidDocument/uploadslavebinary", [
            'base64_binary_file' => $base64BinaryFile,
            'mime_type' => $mimeType,
            'name' => $fileName,
        ]);
    }

    public function uploadHash(
        string $uuidSafe,
        string $sha256,
        string $sha512,
        string $fileName = '',
        string $uuidFolder = ''
    ): array {
        return $this->client->post("documents/$uuidSafe/uploadhash", [
            'sha256' => $sha256,
            'sha512' => $sha512,
            'name' => $fileName,
            'uuid_folder' => $uuidFolder,
        ]);
    }

    public function addSigners(string $uuidDocument, array $signers): array
    {
        return $this->client->post(
            "documents/$uuidDocument/createlist",
            ['signers' => json_encode($signers)]
        );
    }

    public function removeSigners(string $uuidDocument, string $signerEmail, string $signerKey): array
    {
        return $this->client->post(
            "documents/$uuidDocument/removeemaillist",
            ['email-signer' => $signerEmail, 'key-signer' => $signerKey]
        );
    }

    protected function isValidResource($file)
    {
        if (false === is_resource($file)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Argument must be a valid resource type. %s given.',
                    gettype($file)
                )
            );
        }
    }
}
