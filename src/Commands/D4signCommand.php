<?php

namespace Emaia\D4sign\Commands;

use Illuminate\Console\Command;

class D4signCommand extends Command
{
    public $signature = 'laravel-d4sign';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
