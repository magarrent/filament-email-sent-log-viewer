<?php

namespace Magarrent\FilamentEmailSentLogViewer\Commands;

use Illuminate\Console\Command;

class FilamentEmailSentLogViewerCommand extends Command
{
    public $signature = 'filament-email-sent-log-viewer';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
