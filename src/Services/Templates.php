<?php

namespace Emaia\D4sign\Services;

use Emaia\D4sign\Service;

class Templates extends Service
{
    public function all(): array
    {
        return $this->client->post('templates');
    }
}
