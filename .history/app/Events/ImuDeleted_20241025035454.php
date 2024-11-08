<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ImuDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $imuId;

    /**
     * Create a new event instance.
     */
    public function __construct($imuId)
    {
        $this->imuId = $imuId;
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
        return 'delete-imu';
    }

    public function broadcastWith()
    {
        return ['imuId' => $this->imuId];
    }
}