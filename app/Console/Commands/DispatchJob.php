<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SeedDataJob;

class DispatchJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dispatch-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SeedDataJob::dispatch();
        $this->info('Job has been dispatched to insert 1,000,000 records.');
    }
}
