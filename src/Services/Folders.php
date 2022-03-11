<?php

namespace Emaia\D4sign\Services;

use Emaia\D4sign\Service;

class Folders extends Service
{
    public function find(string $uuid_safe): array
    {
        return $this->client->get("folders/{$uuid_safe}/find");
    }

    public function create(string $uuid_safe, string $folder_name): array
    {
        return $this->client->post("folders/{$uuid_safe}/create", [
            'folder_name' => $folder_name,
        ]);
    }

    public function rename(string $uuid_safe, string $uuid_folder, string $folder_name): array
    {
        return $this->client->post("folders/{$uuid_safe}/rename", [
            'uuid_folder' => $uuid_folder,
            'folder_name' => $folder_name,
        ]);
    }
}
