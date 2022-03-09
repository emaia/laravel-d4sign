<?php

namespace Emaia\D4sign\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Emaia\D4sign::greet
 * @method static string greet()
 * @method static string saiHy(string $name)
 * @see \Emaia\D4sign\D4sign
 */
class D4sign extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'd4sign';
    }
}
