<?php

namespace App\Listeners;

use App\Events\VolunteerAccountPublished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VolunteerEmailPublishNotice
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
     * @param  VolunteerAccountPublished  $event
     * @return void
     */
    public function handle(VolunteerAccountPublished $event)
    {
        $data['volunteer_name'] = $event->volunteer->name_first . ' ' . $event->volunteer->name_last;
        Mail::send('templates.email.volunteer_publish_account_email', $data, function ($m) use ($event) {
            $m->from(env('MAIL_FROM'), trans('global.siteTitle'));

            $m->to($event->volunteer->email, $event->volunteer->name_first . ' ' . $event->volunteer->name_last)
                ->subject(trans('people.event.volunteer_publish_notice_email'));
        });
    }
}
