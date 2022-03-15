<?php

namespace Emaia\D4sign\Services;

use Emaia\D4sign\Service;

class Folders extends Service
{
    public function find(string $uuidSafe): array
    {
        return $this->client->get("folders/{$uuidSafe}/find");
    }

    public function create(string $uuidSafe, string $folderName): array
    {
        return $this->client->post("folders/{$uuidSafe}/create", [
            'folder_name' => $folderName,
        ]);
    }

    public function rename(string $uuidSafe, string $uuid_folder, string $folderName): array
    {
        return $this->client->post("folders/{$uuidSafe}/rename", [
            'uuid_folder' => $uuid_folder,
            'folder_name' => $folderName,
        ]);
    }
}
