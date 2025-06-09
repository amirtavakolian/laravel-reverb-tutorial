<?php

namespace App\Events\Chat;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/*

🔴 1- first
here we want to see
if we want to organize our events in different directories
not only in App/Events, what should we do
*/


class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $username;

    public function __construct($message, $username = null)
    {
        $this->message = $message;
        $this->username = $username;
    }

    public function broadcastOn()
    {
        return new Channel('chatting-time');
    }
}
