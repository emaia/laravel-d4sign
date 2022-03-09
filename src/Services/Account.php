<?php

namespace Emaia\D4sign\Services;

use Emaia\D4sign\Service;

class Account extends Service
{
    public function balance(): array
    {
        return $this->client->get('account/balance');
    }
}
