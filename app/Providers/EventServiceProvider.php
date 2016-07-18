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
        // Manage...
        'App\Events\VolunteerPasswordManualReset' => [
            'App\Listeners\VolunteerSmsNewPassword',
        ],

        'App\Events\VolunteerAccountPublished' => [
             'App\Listeners\VolunteerSmsPublishNotice',
             'App\Listeners\VolunteerEmailPublishNotice',
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
