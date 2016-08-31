<?php

namespace App\Events;

use App\Events\Event;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserPasswordManualReset extends Event
{
    use SerializesModels;
    public $user;
    public $newPassword;


    public function __construct(User $user, $newPassword)
    {
        $this->volunteer = $user;
        $this->newPassword = $newPassword;
    }
    
    public function broadcastOn()
    {
        return [];
    }
}
