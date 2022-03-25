<?php

namespace Emaia\D4sign\Commands;

use Emaia\D4sign\Facades\D4sign;
use Illuminate\Console\Command;

class D4signCommand extends Command
{
    public $signature = 'd4sign:test';

    public $description = 'Test D4sign API connection';

    public function handle(): int
    {
        $response = D4sign::account()->testCall();
        $this->comment("D4sign API: {$response['message']}");

        return self::SUCCESS;
    }
}
