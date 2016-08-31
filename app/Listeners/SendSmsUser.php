<?php

namespace App\Listeners;

use App\Events\UserForgotPassword;
use App\Providers\SmsServiceProvider;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;

class SendSmsUser
{

    public function __construct()
    {
        //
    }

    public function handle(UserForgotPassword $event)
    {
        $token = json_decode($event->user->reset_token, true);
        $msg = trans('people.event.sms_reset_content') . ' ' . $token['reset_token'] . "\n\r" . url('');
        SmsServiceProvider::send($event->user->tel_mobile, $msg);
        return true;
    }
}
