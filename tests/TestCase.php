<?php

namespace Emaia\D4sign\Tests;

use Emaia\D4sign\ClientInterface;
use Emaia\D4sign\D4signServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->app->bind(ClientInterface::class, FakeClient::class);
    }

    protected function getPackageProviders($app)
    {
        return [
            D4signServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
         config()->set('d4sign.token_api', env('D4SIGN_TOKEN_API'));
         config()->set('d4sign.crypt_key', env('D4SIGN_CRYPT_KEY'));
    }
}
