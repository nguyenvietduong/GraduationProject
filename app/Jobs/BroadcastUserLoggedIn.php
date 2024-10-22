<?php

// app/Jobs/BroadcastUserLoggedIn.php
namespace App\Jobs;

use App\Events\UserLoggedInFromAnotherDevice;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BroadcastUserLoggedIn
{
    use Dispatchable, Queueable, SerializesModels;

    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function handle()
    {
        Log::info('Broadcasting user logged in event for user ID: ' . $this->userId);
        broadcast(new UserLoggedInFromAnotherDevice($this->userId));
    }
}
