<?php

namespace Emaia\D4sign;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class Client implements ClientInterface
{
    protected PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::withHeaders([
            'Accept' => 'application/json',
            'tokenAPI' => config('d4sign.token_api'),
            'cryptKey' => config('d4sign.crypt_key'),
        ])->baseUrl($this->getBaseUrl());
    }

    protected function getBaseUrl(): string
    {
        return config('d4sign.environment') === 'production' ? config('d4sign.production_url') : config('d4sign.sandbox_url');
    }

    public function get(string $url, array $query = []): array
    {
        return $this->client->get($url, $query)->json();
    }

    public function post(string $url, array $payload = []): array
    {
        return $this->client->post($url, $payload)->json();
    }

    public function attach(string $name, $content): PendingRequest
    {
        return $this->client->attach($name, $content);
    }
}
