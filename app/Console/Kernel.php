<?php

namespace App\Console;

use App\Console\Commands\Clear;
use App\Console\Commands\CalculateTotals;
use Bugsnag\BugsnagLaravel\OomBootstrapper;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(CalculateTotals::class)->everyMinute();
        $schedule->command(Clear::class)->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    protected function bootstrappers()
    {
        return array_merge(
            [OomBootstrapper::class],
            parent::bootstrappers(),
        );
    }
}
