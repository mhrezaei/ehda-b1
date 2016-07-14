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
//         'App\Events\VolunteerLoggedIn' => [
//              'App\Listeners\InsertVolunteerLogin',
//         ],
//         'App\Events\VolunteerLoggedOut' => [
//              'App\Listeners\UpdateVolunteerLogin',
//         ],
//         'App\Events\VolunteerClick' => [
//              'App\Listeners\UpdateVolunteerLogin',
//         ],
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
