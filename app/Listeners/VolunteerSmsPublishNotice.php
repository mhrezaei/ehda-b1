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
        $msg = trans('people.event.volunteer_publish_notice_sms') . "\n\r" . url('');
        SmsServiceProvider::send($event->volunteer->tel_mobile, $msg);
        return true;
    }
}
