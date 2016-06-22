<?php

namespace App\Events;

use App\Events\Event;
use App\Volunteer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VolunteerLoggedOut extends Event
{
    use SerializesModels;
    public $volunteer ;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Volunteer $volunteer)
    {
        $this->volunteer = $volunteer ;
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
