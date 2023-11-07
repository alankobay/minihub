<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

/**
 * @codeCoverageIgnore
 */
class AnalyseCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:analyse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executa o phpstan para análise do código';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $process = new Process([
            base_path() . '/vendor/bin/phpstan',
            'analyse',
            '--memory-limit=-1',
            '-c',
            'phpstan.neon',
            './app',
        ]);

        $process->run();

        if ($process->isSuccessful()) {
            $this->info('PHPStan ok');

            return $process->getExitCode();
        }

        $this->error($process->getOutput());

        return $process->getExitCode();
    }
}
