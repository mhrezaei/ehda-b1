<?php

namespace App\Listeners;

use App\Events\VolunteerAccountPublished;
use App\Providers\SmsServiceProvider;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;

class VolunteerSmsPublishNotice
{
    public function __construct()
    {
        //
    }

    public function handle(VolunteerAccountPublished $event)
    {
        $token = json_decode($event->volunteer->reset_token, true);
        $msg = trans('people.event.volunteer_publish_notice_sms') . ' ' . $token['reset_token'] . "\n\r" . url('');
        SmsServiceProvider::send($event->volunteer->tel_mobile, $msg);
        return true;
    }
}
