<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VolunteerPasswordManualReset extends Event
{
    use SerializesModels;
    public $volunteer;
    public $newPassword;


    public function __construct(Volunteer $volunteer, $newPassword)
    {
        $this->volunteer = $volunteer;
        $this->newPassword = $newPassword;
    }
    
    public function broadcastOn()
    {
        return [];
    }
}
