<?php

namespace App\Console\Commands;

use SplFileInfo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class TailCommand extends Command
{
    protected $signature = 'tail {--lines=100}';

    protected $description = 'Tail the latest logfile';

    public function handle()
    {
        if (! $path = $this->findLatestLogFile()) {
            $this->warn('Could not find a log file');

            return;
        }

        $lines = $this->option('lines');

        $this->info("start tailing {$path}");

        $tailCommand = "tail -f -n {$lines} ".escapeshellarg($path);

        $this->executeCommand($tailCommand);

        return $path;
    }

    protected function findLatestLogFile()
    {
        $logFile = collect(File::allFiles(storage_path('logs')))
            ->sortByDesc(function (SplFileInfo $file) {
                return $file->getMTime();
            })
            ->first();

        return $logFile
            ? $logFile->getPathname()
            : false;
    }
}
