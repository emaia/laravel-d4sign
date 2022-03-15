<?php

namespace Emaia\D4sign\Services;

use Emaia\D4sign\Service;

class Documents extends Service
{
    public function all(int $page = 1): array
    {
        return $this->client->get('documents', ['pg' => $page]);
    }

    public function find(string $uuidDocument = ''): array
    {
        return $this->client->get(sprintf('documents%s', $uuidDocument ? '/'.$uuidDocument : ''));
    }

    public function fromSafe(string $uuidSafe, int $page = 1): array
    {
        return $this->client->get("documents/{$uuidSafe}/safe", ['pg' => $page]);
    }

    public function fromFolder(string $uuidSafe, string $uuidFolder, int $page = 1): array
    {
        return $this->client->get("documents/{$uuidSafe}/safe/{$uuidFolder}", ['pg' => $page]);
    }

    public function byStatus(int $documentStatusId, int $page = 1): array
    {
        return $this->client->get("documents/{$documentStatusId}/status", ['pg' => $page]);
    }

    public function signers(string $uuidDocument): array
    {
        return $this->client->get("documents/{$uuidDocument}/list");
    }

    public function upload(string $uuidSafe, $file, string $uuidFolder = ''): array
    {
        return $this->client->attach('file', $file)
            ->post(sprintf('documents%s/upload', $uuidSafe ? '/'.$uuidSafe : ''), [
                'uuid_folder' => $uuidFolder,
            ])->json();
    }

    public function uploadAttachment(string $uuidDocument, $file): array
    {
        return $this->client->attach('file', $file)
            ->post("documents/{$uuidDocument}/uploadslave")
            ->json()
        ;
    }

    public function uploadBinary(
        string $uuidSafe,
        string $base64BinaryFile,
        string $mimeType,
        string $fileName,
        string $uuidFolder = ''
    ): array {
        return $this->client->post("documents/{$uuidSafe}/uploadbinary", [
            'base64_binary_file' => $base64BinaryFile,
            'mime_type' => $mimeType,
            'name' => $fileName,
            'uuid_folder' => $uuidFolder,
        ]);
    }

    public function addSigners(string $uuidDocument, array $signers): array
    {
        return $this->client->post(
            "documents/{$uuidDocument}/createlist",
            ['signers' => json_encode($signers)]
        );
    }
}
