<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendEmail extends Event
{
    use SerializesModels;

    public $emails = [] ;
    public $text ;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($emails , $text)
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
