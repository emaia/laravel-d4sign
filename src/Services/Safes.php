<?php

namespace Emaia\D4sign\Services;

use Emaia\D4sign\Service;

class Safes extends Service
{
    public function all(): array
    {
        return $this->client->get('safes');
    }
}
