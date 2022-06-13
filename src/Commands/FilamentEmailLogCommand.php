<?php

namespace Ramnzys\FilamentEmailLog\Commands;

use Illuminate\Console\Command;

class FilamentEmailLogCommand extends Command
{
    public $signature = 'filament-email-log';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
