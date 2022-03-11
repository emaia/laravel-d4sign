<?php

namespace Emaia\D4sign;

abstract class Service
{
    protected ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = new $client();
    }
}
