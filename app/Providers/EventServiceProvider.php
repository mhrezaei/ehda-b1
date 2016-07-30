<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Psy\Util\Str;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\VolunteerForgotPassword' => [
            'App\Listeners\SendEmailVolunteer',
            'App\Listeners\SendSmsVolunteer',
        ],
        // Manage...
        'App\Events\VolunteerPasswordManualReset' => [
            'App\Listeners\VolunteerSmsNewPassword',
        ],

        'App\Events\VolunteerAccountPublished' => [
             'App\Listeners\VolunteerSmsPublishNotice',
             'App\Listeners\VolunteerEmailPublishNotice',
        ],

        'App\Events\SendSms' => [
             'App\Listeners\SendSmsListener',
        ],

        'App\Events\SendEmail' => [
             'App\Listeners\SendEmailListener',
        ],


    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
        //
    }
}
