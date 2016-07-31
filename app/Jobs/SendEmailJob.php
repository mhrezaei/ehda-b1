<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    public $email_address;
    public $subject;
    public $msg_body;
    public $reciever_name;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email_address, $reciever_name, $subject, $msg_body)
    {
        $this->email_address = $email_address;
        $this->reciever_name = $reciever_name;
        $this->subject = $subject;
        $this->msg_body['data'] = $msg_body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('templates.email.send_email', $this->msg_body, function ($m) {
            $m->from(env('MAIL_FROM'), trans('global.siteTitle'));

            $m->to($this->email_address, $this->reciever_name)
                ->subject($this->subject);
        });
    }
}
