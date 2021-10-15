<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast; 
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Artikel implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $guest1;
    public $guest2;
    public $guest3;
    public $guest4;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($guest1,$guest2,$guest3,$guest4)
    {
        $this->guest1 = $guest1;
        $this->guest2 = $guest2;
        $this->guest3 = $guest3;
        $this->guest4 = $guest4;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('channel');
    }
}
