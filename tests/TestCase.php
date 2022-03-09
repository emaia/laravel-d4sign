<?php

namespace Emaia\D4sign\Tests;

use Emaia\D4sign\D4signServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            D4signServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
         config()->set('d4sign.token_api', env('D4SIGN_API_KEY'));
         config()->set('d4sign.crypt_key', env('D4SIGN_CRYPT_KEY'));
    }
}
