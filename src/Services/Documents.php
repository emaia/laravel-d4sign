<?php

namespace Emaia\D4sign\Services;

use Emaia\D4sign\Service;

class Documents extends Service
{
    public function all(int $page = 1): array
    {
        return $this->client->get('documents', ['pg' => $page]);
    }

    public function find(string $uuid_document = ''): array
    {
        return $this->client->get(sprintf('documents%s', $uuid_document ? '/'.$uuid_document : ''));
    }

    public function fromSafe(string $uuid_safe, int $page = 1): array
    {
        return $this->client->get("documents/{$uuid_safe}/safe", ['pg' => $page]);
    }

    public function fromFolder(string $uuid_safe, string $uuid_folder, int $page = 1): array
    {
        return $this->client->get("documents/{$uuid_safe}/safe/{$uuid_folder}", ['pg' => $page]);
    }

    public function byStatus(int $documentStatusId, int $page = 1): array
    {
        return $this->client->get("documents/{$documentStatusId}/status", ['pg' => $page]);
    }

    public function signers(string $uuid_document): array
    {
        return $this->client->get("documents/{$uuid_document}/list");
    }

    public function upload(string $uuid_safe, $file, string $uuid_folder = ''): array
    {
        return $this->client->attach('file', $file)
            ->post(sprintf('documents%s/upload', $uuid_safe ? '/'.$uuid_safe : ''), [
                'uuid_folder' => $uuid_folder,
            ])->json();
    }
}
