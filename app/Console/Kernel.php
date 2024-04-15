<?php

namespace App\Console;

use App\Console\Commands\UpdateCategoryMainCommand;
use App\Console\Commands\UpdateCategorySubCommand;
use App\Jobs\SitemapJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->job(SitemapJob::class)->dailyAt('04:00');

        $schedule->command(UpdateCategoryMainCommand::class)->dailyAt('05:00');
        $schedule->command(UpdateCategorySubCommand::class)->dailyAt('06:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
