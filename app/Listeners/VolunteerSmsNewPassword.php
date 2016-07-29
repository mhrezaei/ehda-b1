<?php

namespace App\Listeners;

use App\Events\VolunteerPasswordManualReset;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VolunteerSmsNewPassword
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
     * @param  VolunteerPasswordManualReset  $event
     * @return void
     */
    public function handle(VolunteerPasswordManualReset $event)
    {
        //
    }
}
