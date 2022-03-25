<?php

namespace Emaia\D4sign\Services;

use Emaia\D4sign\Service;

class Groups extends Service
{
    public function all(string $uuidSafe): array
    {
        return $this->client->get("groups/{$uuidSafe}");
    }
}
