<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VolunteerPasswordManualReset extends Event
{
    use SerializesModels;

    public $volunteer ;
    public $new_password;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($volunteer , $new_password)
    {
        $this->volunteer = $volunteer ;
        $this->new_password = $new_password ;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
