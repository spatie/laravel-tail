<?php

namespace Spatie\Tail;

use SplFileInfo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class TailCommand extends Command
{
    protected $signature = 'tail
                            {--lines=0 : Output the last number of lines}
                            {--H|hide-stack-traces : Filter out the stack traces}
                            {--clear : Clear the terminal screen}';

    protected $description = 'Tail the latest logfile';

    public function handle()
    {
        $logDirectory = storage_path('logs');

        if (! $path = $this->findLatestLogFile($logDirectory)) {
            $this->warn("Could not find a log file in `{$logDirectory}`.");

            return;
        }

        $lines = $this->option('lines');

        $filters = $this->getFilters();

        $tailCommand = "tail -n {$lines} -f ".escapeshellarg($path)." {$filters}";

        $this->handleClearOption();

        (new Process($tailCommand))
            ->setTty(true)
            ->setTimeout(null)
            ->run(function ($type, $line) {
                $this->handleClearOption();

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

    protected function handleClearOption()
    {
        if (! $this->option('clear')) {
            return;
        }

        $this->output->write(sprintf("\033\143\e[3J"));
    }

    protected function getFilters()
    {
        if ($this->option('hide-stack-traces')) {
            return '| grep -i -E "^\[\d{4}\-\d{2}\-\d{2} \d{2}:\d{2}:\d{2}\]|Next [\w\W]+?\:" --color';
        }
    }
}
