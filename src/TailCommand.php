<?php

namespace Spatie\Tail;

use SplFileInfo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class TailCommand extends Command
{
    protected $signature = 'tail {--lines=0} {--clear}';

    protected $description = 'Tail the latest logfile';

    public function handle()
    {
        $logDirectory = storage_path('logs');

        if (! $path = $this->findLatestLogFile($logDirectory)) {
            $this->warn("Could not find a log file in `{$logDirectory}`.");

            return;
        }

        $lines = $this->option('lines');

        $tailCommand = "tail -f -n {$lines} ".escapeshellarg($path);

        $this->optionallyClear();

        (new Process($tailCommand))
            ->setTimeout(null)
            ->run(function ($type, $line) {
                $this->optionallyClear();

                $this->output->write($line);
            });
    }

    protected function findLatestLogFile(string $directory)
    {
        $logFile = collect(File::allFiles($directory))
            ->sortByDesc(function (SplFileInfo $file) {
                return $file->getMTime();
            })
            ->first();

        return $logFile
            ? $logFile->getPathname()
            : false;
    }

    protected function optionallyClear()
    {
        if (!$this->option('clear')) {
            return;
        }

        $this->output->write(sprintf("\033\143\e[3J"));
    }

    protected function executeCommand($command)
    {
        $output = $this->output;
    }
}
