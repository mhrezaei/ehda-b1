<?php

namespace App\Listeners;

use App\Events\VolunteerPasswordManualReset;
use App\Providers\SmsServiceProvider;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;

class VolunteerSmsNewPassword
{
    public function __construct()
    {
        //
    }

    public function handle(VolunteerPasswordManualReset $event)
    {
        $msg = trans('people.event.volunteer_new_password_sms') . ' ' . $event->newPassword . "\n\r" . url('');
        SmsServiceProvider::send($event->volunteer->tel_mobile, $msg);
        return true;
    }
}
