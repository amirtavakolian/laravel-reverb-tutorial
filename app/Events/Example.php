<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


#  🔴 2- then read this file

/*
    we can broadcast this event from our application.

    # example of an event:
    when a user has registered and a listener on that event might send him/her an email.

    in this example => event needs to broadcast a message to our server.
*/

/*
    you have to implement ShouldBroadcastNow or ShouldBroadcast
    so this event will get broadcast-able;
    ShouldBroadcast => put the event in the queue and when you run
    your queue, it will broadcast this event for us.
*/

class Example implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /*
        from constructor, we can pass any data in here
        that we need to broadcast or use within our event.
    */

    public string $message;

    public string $test = "test";

    public User $user;

    public function __construct(string $message, User $user)
    {
        $this->message = $message;

        $this->user = $user;
    }

    /*
        if you don't need broadcasting (just event & listener) remove broadcastOn() method
        but here we want to broadcast on a specific channel or multiple channels.

        -----------------------------------------

        we have diffrent channels for broadcasting
        and each channel has diffrent options.
        We're going to be covering all of these throughout the course.

        -----------------------------------------

        in our case, we want to broadcast on a standard channel, not on a private channel.
        so use => new Channel('name-of-the-channel')
    */

    public function broadcastOn(): array
    {
        return [
            new Channel('chat'),
        ];
    }

    // if you use broadcastWith, all the data in the properties will not broadcast to client
    // only the data in the below array will send to client
    public function broadcastWith()
    {
        return [
            "extra" => "Extra Data 😂",
            "message" => $this->message,
            'user' => $this->user
        ];
    }


}



