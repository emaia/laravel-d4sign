<?php

namespace Emaia\D4sign\Facades;

use Emaia\D4sign\Services\Account;
use Emaia\D4sign\Services\Safes;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Emaia\D4sign\D4sign
 * @see \Emaia\D4sign\D4sign::account
 * @method Account account()
 * @see \Emaia\D4sign\D4sign::safes
 * @method Safes safes()
 */
class D4sign extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'd4sign';
    }
}
