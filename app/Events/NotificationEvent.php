<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $dataNotification;

    public function __construct($dataNotification)
    {
        $this->dataNotification = $dataNotification;
    }

    public function broadcastOn()
    {
        return new Channel('notifications');
    }

    public function broadcastWith()
    {
        return [
            'dataNotification' => $this->dataNotification,
        ];
    }
}
