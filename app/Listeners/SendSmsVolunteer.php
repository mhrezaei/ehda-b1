<?php

namespace App\Listeners;

use App\Events\VolunteerForgotPassword;
use App\Providers\SmsServiceProvider;
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
        $token = json_decode($event->volunteer->reset_token, true);
        $msg = trans('people.event.sms_reset_content') . ' ' . $token['reset_token'] . "\n\r" . 'http://www.ehda.center';
        SmsServiceProvider::send($event->volunteer->tel_mobile, $msg);
    }
}
