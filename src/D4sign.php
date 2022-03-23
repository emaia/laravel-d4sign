<?php

namespace Emaia\D4sign;

use Emaia\D4sign\Services\Account;
use Emaia\D4sign\Services\Documents;
use Emaia\D4sign\Services\Folders;
use Emaia\D4sign\Services\Groups;
use Emaia\D4sign\Services\Safes;
use Emaia\D4sign\Services\Signers;
use Emaia\D4sign\Services\Templates;

class D4sign
{
    public function __construct(
        public Account $account,
        public Documents $documents,
        public Folders $folders,
        public Groups $groups,
        public Safes $safes,
        public Signers $signers,
        public Templates $templates,
    ) {
    }

    public function account(): Account
    {
        return $this->account;
    }

    public function documents(): Documents
    {
        return $this->documents;
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

    public function signers(): Signers
    {
        return $this->signers;
    }

    public function templates(): Templates
    {
        return $this->templates;
    }
}
