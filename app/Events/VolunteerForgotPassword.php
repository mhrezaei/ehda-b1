<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Volunteer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VolunteerForgotPassword extends Event
{
    use SerializesModels;
    public $volunteer;

    public function __construct(Volunteer $volunteer)
    {
        $this->volunteer = $volunteer;
    }
    
    public function broadcastOn()
    {
        return [];
    }
}
