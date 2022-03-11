<?php

use Emaia\D4sign\Tests\TestCase;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Http;

uses(TestCase::class)->in(__DIR__);

function mockHttpResponse(array $response, int $status = 200): Factory
{
    return Http::fake([
        'https://sandbox.d4sign.com.br/api/*' => Http::response($response, $status),
    ]);
}
