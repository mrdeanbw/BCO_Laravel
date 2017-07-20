<?php

namespace App\Listeners;

use App\Events\UserAdminVerified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserAdminVerifiedListener
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
     * @param  UserAdminVerified  $event
     * @return void
     */
    public function handle(UserAdminVerified $event)
    {
        // Send an email to Exfreight
        $exfreight = \App\Vendor::where('name', 'EXFREIGHT')->firstOrFail();
        $exfreight->notify(new \App\Notifications\ExfreightUserNotification($event->user));
        $event->user->exfreight_status = 'Pending';
        $event->user->save();
    }
}
