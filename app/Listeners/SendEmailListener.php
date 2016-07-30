<?php

namespace App\Listeners;

use App\Events\SendEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailListener
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
     * @param  SendEmail  $event
     * @return void
     */
    public function handle(SendEmail $event)
    {
        Mail::send('templates.email.send_email', $event->msg_body, function ($m) use ($event) {
            $m->from(env('MAIL_FROM'), trans('global.siteTitle'));

            $m->to($event->email_address, $event->reciever_name)
                ->subject($event->subject);
        });
    }
}
