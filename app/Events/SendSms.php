<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendSms extends Event
{
    use SerializesModels;
    public $mobiles_number;
    public $msg;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($mobiles_number, $msg)
    {
        $this->mobiles_number = $mobiles_number;
        $this->msg = $msg;
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
