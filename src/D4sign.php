<?php

namespace Emaia\D4sign;

use Emaia\D4sign\Services\Account;
use Emaia\D4sign\Services\Folders;
use Emaia\D4sign\Services\Groups;
use Emaia\D4sign\Services\Safes;

class D4sign
{
    public function __construct(
        public Account $account,
        public Safes $safes,
        public Folders $folders,
        public Groups $groups
    ) {}

    public function account(): Account
    {
        return $this->account;
    }

    public function folders(): Folders
    {
        return $this->folders;
    }

    public function groups(): Groups
    {
        return $this->groups;
    }

    public function safes(): Safes
    {
        return $this->safes;
    }
}
