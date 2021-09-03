<?php

namespace App\Providers;

use App\Events\ConfirmSubscription;
use App\Listeners\SendConfirmation;
use function Illuminate\Events\queueable;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ConfirmSubscription::class => [
            SendConfirmation::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        // Event::listen(
        //     ConfirmSubscription::class,
        //     [SendConfirmation::class, 'handle']
        // );

        // Event::listen(queueable(function (ConfirmSubscription $event) {
        //     //
        // }));
    }
}
