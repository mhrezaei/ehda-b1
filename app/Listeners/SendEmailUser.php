<?php

namespace App\Listeners;

use App\Events\UserForgotPassword;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailUser
{
    public function __construct()
    {
        //
    }

    public function handle(UserForgotPassword $event)
    {
        $token = json_decode($event->user->reset_token, true);
//        Mail::send('templates.email.reset_password_email', $token, function ($m) use ($event) {
//            $m->from(env('MAIL_FROM'), trans('global.siteTitle'));
//
//            $m->to($event->user->email, $event->user->name_first . ' ' . $event->user->name_last)
//                ->subject(trans('people.event.email_reset_password_title'));
//        });
    }
}
