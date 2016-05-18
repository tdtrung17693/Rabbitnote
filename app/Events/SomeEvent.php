<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SomeEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    protected $user;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ["user-{$this->user->id}"];
    }

    public function broadcastAs()
    {
        return "notes:saved";
    }
}
