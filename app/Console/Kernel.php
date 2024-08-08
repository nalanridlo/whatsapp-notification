<?php

namespace App\Console;

use App\Models\Reminder;
use App\Jobs\SendReminder;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $reminders = Reminder::all();
    foreach ($reminders as $reminder) {
        $reminderDateTime = $reminder->reminder_date . ' ' . $reminder->reminder_time;
        $schedule->job(new SendReminder($reminder))->at($reminderDateTime);
    }
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
