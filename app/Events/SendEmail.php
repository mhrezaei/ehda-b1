<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendEmail extends Event
{
    use SerializesModels;
    public $email_address;
    public $subject;
    public $msg_body;
    public $reciever_name;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email_address, $reciever_name, $subject, $msg_body)
    {
        $this->email_address = $email_address;
        $this->reciever_name = $reciever_name;
        $this->subject = $subject;
        $this->msg_body['data'] = $msg_body;
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
