<?php

namespace Emaia\D4sign\Tests;

use Emaia\D4sign\ClientInterface;

class FakeClient implements ClientInterface
{

    public function get(string $url, array $query = []): array
    {
        $data = file_get_contents(__DIR__.'/Mocks/'.$url.'.json');
        return json_decode($data, true);
    }

    public function post(string $url, array $payload = []): array
    {
        $data = file_get_contents(__DIR__.'/Mocks/'.$url.'.json');
        return json_decode($data, true);
    }

    public function attach(string $name, $content): static
    {
        return $this;
    }
}
