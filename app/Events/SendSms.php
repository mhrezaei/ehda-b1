<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendSms extends Event
{
    use SerializesModels;

    public $numbers = [] ;
    public $text ;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($numbers , $text)
    {
        //
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
