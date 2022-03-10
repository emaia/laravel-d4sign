<?php

namespace Emaia\D4sign;

interface ClientInterface
{
    public function get(string $url, array $query = []): array;
    public function post(string $url, array $payload = []): array;
}
