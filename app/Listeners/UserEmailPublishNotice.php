<?php

namespace App\Listeners;

use App\Events\UserAccountPublished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEmailPublishNotice
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
     * @param UserAccountPublished $event
     */
    public function handle(UserAccountPublished $event)
    {
        $data['volunteer_name'] = $event->user->name_first . ' ' . $event->user->name_last;
        Mail::send('templates.email.volunteer_publish_account_email', $data, function ($m) use ($event) {
            $m->from(env('MAIL_FROM'), trans('global.siteTitle'));

            $m->to($event->user->email, $event->user->name_first . ' ' . $event->user->name_last)
                ->subject(trans('people.event.volunteer_publish_notice_email'));
        });
    }
}
