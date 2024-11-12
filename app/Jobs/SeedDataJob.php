<?php

namespace App\Jobs;

use App\Models\Career;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Jobs\CareerSeedJob;
use App\Models\Staff;
use App\Jobs\StaffSeedJob;
class SeedDataJob implements ShouldQueue
{
    use Queueable;

    protected $totalRecords;
    protected $batchSize;
    /**
     * Create a new job instance.
     */
    public function __construct($totalRecords = 1000, $batchSize = 250)
    {
        $this->totalRecords = $totalRecords;
        $this->batchSize = $batchSize;
    }

    /**
     * Execute the job.
     */
    public function handle(): void

    {
        //For Staff
        $ceo = Staff::create([
            "name"=> "Lam",
            "level" =>"CEO",
        ]);

        // Số lượng bản ghi cần tạo
        $batches = ceil($this->totalRecords / $this->batchSize);

        // Dispatch từng batch
        for ($i = 0; $i < $batches; $i++) {
            StaffSeedJob::dispatch($ceo, $this->batchSize);
        }

        // //For Career + User
        // $batches = ceil($this->totalRecords / $this->batchSize);

        // for ($i = 0; $i < $batches; $i++) {
        //     // CareerSeedJob::dispatch($this->batchSize);
        //     UserSeedJob::dispatch($this->batchSize);
        // }
    }
}
