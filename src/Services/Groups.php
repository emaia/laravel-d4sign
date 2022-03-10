<?php

namespace Emaia\D4sign\Services;

use Emaia\D4sign\Service;

class Groups extends Service
{
    public function all(string $uuid_safe): array
    {
        return $this->client->get("groups/{$uuid_safe}");
    }
}
