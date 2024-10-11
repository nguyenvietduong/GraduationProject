<?php

namespace App\Jobs;

use App\Events\NotificationEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $title;
    protected $message;
    protected $type;
    protected $data;

    public function __construct($title, $message, $type = 'info', $data = null)
    {
        $this->title = $title;
        $this->message = $message;
        $this->type = $type;
        $this->data = $data;
    }

    public function handle()
    {
        try {
            Log::info('SendNotificationJob started', ['message' => $this->message]);

            // Phát sự kiện để gửi thông báo
            event(new NotificationEvent($this->title, $this->message, $this->type, $this->data));

            Log::info('SendNotificationJob completed successfully', ['message' => $this->message]);
        } catch (\Exception $e) {
            Log::error('Error in SendNotificationJob', [
                'message' => $this->message ?? 'N/A',
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}
