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
        $date['a'] = 1;
        $date['b'] = 2;
        $date['name'] = $event->volunteer->name_first;
        Mail::send('templates.widget.email', ['array' => $date], function ($m) use ($event) {
            $m->from('no-reply@ehda.center', trans('global.siteTitle'));

            $m->to($event->volunteer->email, $event->volunteer->name_first)->subject(trans('people.event.email_reset_password_title'));
        });
    }
}
