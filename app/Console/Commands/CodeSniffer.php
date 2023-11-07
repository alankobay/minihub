<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

/**
 * @codeCoverageIgnore
 */
class CodeSniffer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:sniffer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute o comando phpcs';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $process = new Process([
            base_path() . '/vendor/bin/phpcs',
            'app',
            '--colors',
            '--standard=PSR12',
        ]);

        $process->run();

        if ($process->isSuccessful()) {
            $this->info('PHPCS ok');
            return $process->getExitCode();
        }

        $this->error($process->getOutput());
        return $process->getExitCode();
    }
}
