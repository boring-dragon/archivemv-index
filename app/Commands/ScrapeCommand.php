<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Feed;
class ScrapeCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'scrape';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'The the scrape process of archive mv';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Feed)
    {
        
       dd($feeds);
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule)
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
