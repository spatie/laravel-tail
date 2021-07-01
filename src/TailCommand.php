<?php

namespace Spatie\Tail;

use Exception;
use Illuminate\Console\Command;
use Spatie\Ssh\Ssh;
use Symfony\Component\Process\Process;

class TailCommand extends Command
{
    protected $signature = 'tail {environment?}
                            {--file= : Name of the log file to tail}
                            {--lines=0 : Output the last number of lines}
                            {--clear : Clear the terminal screen}
                            {--grep= : Grep specified string}
                            {--debug : Display the underlying tail command}';

    protected $description = 'Tail the latest logfile';

    public function handle()
    {
        if ($this->option('debug')) {
            $this->info($this->getTailCommand());

            return;
        }

        $this->handleClearOption();

        $environment = $this->argument('environment');

        is_null($environment)
            ? $this->tailLocally()
            : $this->tailRemotely($environment);
    }

    protected function handleClearOption()
    {
        if (! $this->option('clear')) {
            return;
        }

        $this->output->write(sprintf("\033\143\e[3J"));
    }

    protected function tailLocally(): void
    {
        $logDirectory = storage_path('logs');

        Process::fromShellCommandline($this->getTailCommand(), $logDirectory)
            ->setTty(true)
            ->setTimeout(null)
            ->run(function ($type, $line) {
                $this->handleClearOption();

                $this->output->write($line);
            });
    }

    protected function tailRemotely(string $environment): void
    {
        $environmentConfig = $this->getEnvironmentConfiguration($environment);

        Ssh::create($environmentConfig['user'], $environmentConfig['host'])
            ->configureProcess(fn (Process $process) => $process->setTty(true))
            ->onOutput(function ($type, $line) {
                $this->handleClearOption();

                $this->output->write($line);
            })
            ->execute([
                "cd {$environmentConfig['log_directory']}",
                $this->getTailCommand(),
            ]);
    }

    protected function getEnvironmentConfiguration(string $environment): array
    {
        $config = config('tail');

        if (! isset($config[$environment])) {
            throw new Exception("No configuration set for environment `{$environment}`. Make sure this environment is specified in the `tail` config file!");
        }

        return $config[$environment];
    }

    public function getTailFile(): string
    {
        $environment = $this->argument('environment');
        $environmentConfig = is_null($environment)
            ? []
            : $this->getEnvironmentConfiguration($environment);

        return $this->option('file')
            ?? $environmentConfig['file']
            ?? "`\\ls -t | \\head -1`";
    }

    public function getTailCommand(): string
    {
        $grep = $this->option('grep')
            ? ' | \\grep "'.$this->option('grep').'"'
            : '';
        $file = $this->getTailFile();

        return '\\tail -f -n '.$this->option('lines').' "'.$file.'"'.$grep;
    }
}
