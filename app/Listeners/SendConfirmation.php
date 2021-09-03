<?php

namespace App\Listeners;

use App\Events\ConfirmSubscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendConfimation;

class SendConfirmation implements ShouldQueue
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
     * @param  ConfirmSubscription  $event
     * @return void
     */
    public function handle(ConfirmSubscription $event)
    {
        $subscriber = $event->subscriber;
        \Log::info(print_r($subscriber, true));
        Mail::to($subscriber->email)->send(new SendConfimation($subscriber));
    }
}
