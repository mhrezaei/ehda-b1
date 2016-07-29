<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Providers\SmsServiceProvider;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendTestMail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    protected $emailAddress;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
//        $t['reset_token'] = 12345;
//        $mailer->send('templates.widget.reset_password_email', $t, function($message) {
//            $message->from(env('MAIL_FROM'), 'Queue Test Sender');
//            $message->to($this->emailAddress)->subject('Welcome Email');
//        });
        SmsServiceProvider::send($this->emailAddress, 'hi');
    }
}
