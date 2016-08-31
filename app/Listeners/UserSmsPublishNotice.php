<?php

namespace App\Listeners;

use App\Events\UserAccountPublished;
use App\Providers\SmsServiceProvider;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;

class UserSmsPublishNotice
{
    public function __construct()
    {
        //
    }

    /**
     * @param UserAccountPublished $event
     * @return bool
     */
    public function handle(UserAccountPublished $event)
    {
        $msg = trans('people.event.volunteer_publish_notice_sms') . "\n\r" . url('');
        SmsServiceProvider::send($event->user->tel_mobile, $msg);
        return true;
    }
}
