<?php

namespace Emaia\D4sign\Facades;

use Emaia\D4sign\Services\Account;
use Emaia\D4sign\Services\Documents;
use Emaia\D4sign\Services\Folders;
use Emaia\D4sign\Services\Groups;
use Emaia\D4sign\Services\Safes;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Emaia\D4sign\D4sign
 * @method static Account account()
 * @method static Documents documents()
 * @method static Folders folders()
 * @method static Groups groups()
 * @method static Safes safes()
 */
class D4sign extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'd4sign';
    }
}
