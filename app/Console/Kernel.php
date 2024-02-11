<?php

namespace App\Console;

use App\Console\Commands\FlushPendingBookings;
use App\Console\Commands\SendBookingReminders;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        FlushPendingBookings::class,
        SendBookingReminders::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
//        $schedule->command('flush-pending-bookings')->everyMinute()->when(function () {
//            return now()->minute % 20 == 0;
//        });
//
//        $schedule->command('send-booking-reminders')->everyMinute()->when(function () {
//            return now()->minute % 10 == 0;
//        });
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
