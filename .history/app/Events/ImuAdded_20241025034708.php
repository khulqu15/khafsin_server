<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ImuAdded
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
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        // return [
        //     new PrivateChannel('channel-name'),
        // ];
        return ['imu-data'];
    }

    public function broadcastAs()
    {
        return 'add-imu';
    }

    public function broadcastWith()
    {
        return ['imu' => $this->imu];
    }
}
