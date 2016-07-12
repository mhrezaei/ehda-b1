<?php

namespace App\Listeners;

use App\Events\VolunteerForgotPassword;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailVolunteer
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
     * @param  VolunteerForgotPassword  $event
     * @return void
     */
    public function handle(VolunteerForgotPassword $event)
    {
        $token = json_decode($event->volunteer->reset_token, true);
        Mail::send('templates.widget.reset_password_email', $token, function ($m) use ($event) {
            $m->from('no-reply@ehda.center', trans('global.siteTitle'));

            $m->to($event->volunteer->email, $event->volunteer->name_first . ' ' . $event->volunteer->name_last)->subject(trans('people.event.email_reset_password_title'));
        });
    }
}
