<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PublishNotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $message;
    protected $userID;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $userID)
    {
        $this->message = $message;
        $this->userID = $userID;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('my-channel-' . $this->userID);
    }

    public function broadcastAs()
    {
        return 'my-event';
    }

    public function broadcastWith()
    {
        return $this->message;
    }
}
