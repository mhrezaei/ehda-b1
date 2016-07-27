<?php

namespace App\Listeners;

use App\Events\VolunteerForgotPassword;
use App\Providers\SmsServiceProvider;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;

class SendSmsVolunteer
{

    public function __construct()
    {
        //
    }

    public function handle(VolunteerForgotPassword $event)
    {
        $token = json_decode($event->volunteer->reset_token, true);
        $msg = trans('people.event.sms_reset_content') . ' ' . $token['reset_token'] . "\n\r" . url('');
        SmsServiceProvider::send($event->volunteer->tel_mobile, $msg);
        return true;
    }
}
