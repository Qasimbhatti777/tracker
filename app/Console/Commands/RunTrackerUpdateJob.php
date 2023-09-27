<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use  App\Jobs\UpdateTrackers;


class RunTrackerUpdateJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tracker-update';
    protected $description = 'Run the TrackerUpdateJob every 1 minute';

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        dispatch(new UpdateTrackers);
    }
}
