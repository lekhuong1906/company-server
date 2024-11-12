<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Staff;
class StaffSeedJob implements ShouldQueue
{
    use Queueable;
    public $parent;
    public $amount;

    /**
     * Create a new job instance.
     */
    public function __construct(Staff $parent, int $amount)
    {
        $this->parent = $parent;
        $this->amount = $amount;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $count = 0;

        while ($count < $this->amount) {
            $manager = Staff::factory()->create();
            $manager->appendToNode($this->parent)->save();

            // Tạo nhân viên dưới Manager này
            foreach (range(1, rand(1, 5)) as $i) {
                if ($count >= $this->amount) {
                    break;
                }

                $employee = Staff::factory()->create();
                $employee->appendToNode($manager)->save();
                $count++;
            }
        }
    }
}
