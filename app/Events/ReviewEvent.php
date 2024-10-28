<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReviewEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $review;

    public function __construct($review)
    {
        $this->review = $review;
    }

    public function broadcastOn()
    {
        return new Channel('reviews');
    }

    public function broadcastWith()
    {
        return [
            'review' => $this->review,
        ];
    }
}
