<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

/**
 * @codeCoverageIgnore
 */
class CheckCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute o comando pmd';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $process = new Process([
            base_path() . '/vendor/bin/phpmd',
            './app/',
            'text',
            'phpmd.xml',
        ]);

        $process->run();

        if ($process->isSuccessful()) {
            $this->info('PHPMD ok');
            return $process->getExitCode();
        }

        $this->error($process->getOutput());
        return $process->getExitCode();
    }
}
