<?php

// app/Events/UserLoggedInFromAnotherDevice.php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserLoggedInFromAnotherDevice implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function broadcastOn()
    {
        return new Channel('user-session.' . $this->userId);
    }

    public function broadcastAs()
    {
        return 'user-logged-in';
    }
}
