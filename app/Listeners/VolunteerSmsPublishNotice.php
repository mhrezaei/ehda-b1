<?php

namespace App\Listeners;

use App\Events\VolunteerAccountPublished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VolunteerSmsPublishNotice
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
     * @param  VolunteerAccountPublished  $event
     * @return void
     */
    public function handle(VolunteerAccountPublished $event)
    {
        //
    }
}
