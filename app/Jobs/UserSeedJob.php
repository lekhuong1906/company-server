<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\User;
class UserSeedJob implements ShouldQueue
{
    use Queueable;
    protected $batchSize;

    /**
     * Create a new job instance.
     */
    public function __construct($batchSize)
    {
        $this->batchSize = $batchSize;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        User::factory()->count($this->batchSize)->create();
    }
}
