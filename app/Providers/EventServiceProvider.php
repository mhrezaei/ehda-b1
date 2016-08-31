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
        'App\Events\UserForgotPassword' => [
            'App\Listeners\SendEmailUser',
            'App\Listeners\SendSmsUser',
        ],
        // Manage...
        'App\Events\UserPasswordManualReset' => [
            'App\Listeners\UserSmsNewPassword',
        ],

        'App\Events\UserAccountPublished' => [
             'App\Listeners\UserSmsPublishNotice',
             'App\Listeners\UserEmailPublishNotice',
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
