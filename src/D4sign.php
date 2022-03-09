<?php

namespace Emaia\D4sign;

use Emaia\D4sign\Services\Account;
use Emaia\D4sign\Services\Safes;

class D4sign
{
    public function __construct(
        public Account $account,
        public Safes $safes
    ) {}

    public function account(): Account
    {
        return $this->account;
    }

    public function safes(): Safes
    {
        return $this->safes;
    }
}
