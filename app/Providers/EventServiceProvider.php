<?php

namespace App\Providers;

use Mail;
use Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Some\Event' => [
            'App\Handlers\Events\AuthLogoutEventHandler',
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

        $events->listen('auth.logout', function ($event) {
            Session::flush();
        });
    }
}
