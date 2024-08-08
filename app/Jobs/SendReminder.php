<?php

namespace App\Jobs;
use App\Models\Reminder;
use App\Services\FonnteService;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reminder;

    public function __construct(Reminder $reminder)
    {
        $this->reminder = $reminder;
    }

    public function handle(FonnteService $fonnteService)
    {
        $fonnteService->sendMessage(
            $this->reminder->phone_number, 
            $this->reminder->message
        );
    }
}
