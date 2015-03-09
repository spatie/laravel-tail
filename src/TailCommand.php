<?php namespace Spatie\Tail;

use Illuminate\Filesystem\Filesystem;
use Spatie\Tail\Remote\SecLibGateway;
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
    protected $description = 'Tail the latest local logfile';

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
        if (is_null($this->argument('connection')))
        {
            $this->tailLocalLogFile();
        }
        else
        {
            $this->tailRemoteLogFile($this->argument('connection'));
        }

    }

    /**
     * Get the path to the latest local Laravel log file.
     *
     * @return null|string
     */
    private function findNewestLocalLogfile()
    {
        $files = glob(storage_path('logs')."/*.log");
        $files = array_combine($files, array_map("filemtime", $files));
        arsort($files);
        $newestLogFile = key($files);

        return $newestLogFile;
    }

    /**
     * Tail a local log file for the application.
     *
     * @param $path
     */
    public function tailLocalLog($path)
    {
        $output = $this->output;

        $lines = $this->option('lines');

        $this->info('start tailing '.$path);

        (new Process('tail -f -n '.$lines.' '.escapeshellarg($path)))->setTimeout(null)->run(function ($type, $line) use ($output) {
            $output->write($line);
        });
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
     * @return null|string
     */
    private function tailLocalLogFile()
    {
        $path = $this->findNewestLocalLogfile();

        $this->tailLocalLog($path);
        return $path;
    }

    protected function tailRemoteLogFile($connection)
    {
        $connectionParameters = config('tail.' . $connection);
        
        $connection = new SecLibGateway($connectionParameters['host'], ['username' => $connectionParameters['username']], new Filesystem());
        $connection->run('ls');

    }
}
