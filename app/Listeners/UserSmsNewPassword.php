<?php

namespace App\Listeners;

use App\Events\UserPasswordManualReset;
use App\Providers\SmsServiceProvider;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;

class UserSmsNewPassword
{
    public function __construct()
    {
        //
    }

    public function handle(UserPasswordManualReset $event)
    {
        $msg = trans('people.event.volunteer_new_password_sms') . ' ' . $event->newPassword . "\n\r" . url('');
        SmsServiceProvider::send($event->user->tel_mobile, $msg);
        return true;
    }
}
