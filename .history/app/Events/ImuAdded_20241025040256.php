<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ImuAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $imu;

    /**
     * Create a new event instance.
     */
    public function __construct($imu)
    {
        $this->imu = $imu;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn()
    {
        // Broadcast to the public 'imu-data' channel
        return new Channel('imu-data');
    }

    /**
     * Set a custom event name
     */
    public function broadcastAs()
    {
        return 'add-imu';
    }

    /**
     * Data to broadcast with the event
     */
    public function broadcastWith()
    {
        return ['imu' => $this->imu];
    }
}
