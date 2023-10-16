<?php

namespace App\Jobs;

use App\Models\Developer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessCreateDeveloper implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;

    public $timeout = 120;

    private $developers;

    /**
     * Create a new job instance.
     */
    public function __construct($developers = [])
    {
        $this->developers = $developers;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Developer::create($this->developers);
    }
}
