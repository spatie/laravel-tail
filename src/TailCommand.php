<?php namespace Spatie\Tail;

use Exception;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Process\Process;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class TailCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tail the latest logfile';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @return mixed
     * @throws Exception
     */
    public function fire()
    {
        if (is_null($this->argument('connection'))) {
            $this->tailLocalLogFile();
        } else {
            $this->tailRemoteLogFile($this->argument('connection'));
        }
    }

    /**
     * Tail the latest local log file
     *
     * @return null|string
     */
    private function tailLocalLogFile()
    {
        $path = $this->findNewestLocalLogfile();

        $lines = $this->option('lines');

        $this->info('start tailing '.$path);

        $tailCommand = 'tail -f -n '.$lines.' '.escapeshellarg($path);

        $this->executeCommand($tailCommand);

        return $path;
    }

    /**
     * Tail the latest remote log file for the given connection
     *
     * @param string $connection
     */
    protected function tailRemoteLogFile($connection)
    {
        $connectionParameters = config('tail.connections.'.$connection);

        $this->guardAgainstInvalidConnectionParameters($connectionParameters);

        $tailCommand = "ssh ".($connectionParameters['user'] == '' ? '' : $connectionParameters['user'] . '@').$connectionParameters['host']." -T 'cd ".$connectionParameters['logDirectory'].";tail -n ".$this->option('lines')." -f $(ls -t | head -n 1)'";

        $this->info('start tailing latest remote log on host '.$connectionParameters['host'].' in directory '.$connectionParameters['logDirectory']);

        $this->executeCommand($tailCommand);
    }

    /**
     * Execute the given command
     *
     * @param string $command
     */
    protected function executeCommand($command)
    {
        $output = $this->output;

        (new Process($command))->setTimeout(null)->run(function ($type, $line) use ($output) {
            $output->write($line);
        });
    }

    /**
     * Get the path to the latest local Laravel log file.
     *
     * @return null|string
     */
    protected function findNewestLocalLogfile()
    {
        $files = glob(storage_path('logs')."/*.log");
        $files = array_combine($files, array_map("filemtime", $files));
        arsort($files);
        $newestLogFile = key($files);

        return $newestLogFile;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['lines', null, InputOption::VALUE_OPTIONAL, 'The number of lines to tail.', 20],
        ];
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('connection', InputArgument::OPTIONAL, 'The remote connection name'),
        );
    }

    /**
     * Guard againt invalid connectionParameters
     *
     * @param $connectionParameters
     * @throws Exception
     */
    protected function guardAgainstInvalidConnectionParameters($connectionParameters)
    {
        if ($connectionParameters['host'] == '')
        {
            throw new Exception('Hostname is required');
        }

        if ($connectionParameters['logDirectory'] == '')
        {
            throw new Exception('LogDirectory is required');
        }
    }
}
