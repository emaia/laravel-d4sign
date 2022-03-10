<?php

namespace Emaia\D4sign;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class Client implements ClientInterface
{
    protected PendingRequest $client;

    protected const ENV_PRODUCTION = 'https://secure.d4sign.com.br/api/v1/';

    protected const ENV_SANDBOX = 'https://sandbox.d4sign.com.br/api/v1/';

    public function __construct()
    {
        $this->client = Http::withHeaders([
            'Accept'   => 'application/json',
            'tokenAPI' => config('d4sign.token_api'),
            'cryptKey' => config('d4sign.crypt_key')
        ])->baseUrl($this->getBaseUrl());
    }

    protected function getBaseUrl(): string
    {
        return config('d4sign.environment') === 'production' ? self::ENV_PRODUCTION : self::ENV_SANDBOX;
    }

    public function get(string $url, array $query = []): array
    {
        return $this->client->get($url, $query)->json();
    }

    public function post(string $url, array $payload = []): array
    {
        return $this->client->post($url, $payload)->json();
    }
}
