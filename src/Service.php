<?php

namespace Emaia\D4sign;

abstract class Service
{
    protected Client $client;

    public function __construct() {
        $this->client = new Client();
    }
}
