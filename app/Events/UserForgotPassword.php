<?php

namespace App\Events;

use App\Events\Event;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserForgotPassword extends Event
{
    use SerializesModels;
    public $user;

    public function __construct(User $user)
    {
        $this->$user = $user;
    }
    
    public function broadcastOn()
    {
        return [];
    }
}
