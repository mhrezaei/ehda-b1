<?php

namespace App\Listeners;

use App\Events\VolunteerForgotPassword;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSmsVolunteer
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  VolunteerForgotPassword  $event
     * @return void
     */
    public function handle(VolunteerForgotPassword $event)
    {
        //
    }
}
